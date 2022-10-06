<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotificationTemplate;
use App\Models\PaymentChannel;
use App\Models\Setting;
use App\Models\AffliatePlans;
use App\Models\Translation\SettingTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class SettingsController extends Controller
{
    public function index()
    {
        removeContentLocale();

        $this->authorize('admin_settings');

        $data = [
            'pageTitle' => trans('oraclepopupsignin/main.settings_title'),
        ];
        return view('admin.settings.index', $data);
    }

    public function page($page)
    {
        removeContentLocale();

        $this->authorize('admin_settings_' . $page);

        $settings = Setting::where('page', $page)
            ->get()
            ->keyBy('name');

        foreach ($settings as $setting) {
            $setting->value = json_decode($setting->value, true);
        }

        $data = [
            'pageTitle' => trans('oraclepopupsignin/main.settings_title'),
            'settings' => $settings
        ];

        if ($page == 'notifications') {
            $data['notificationTemplates'] = NotificationTemplate::all();
        }

        if ($page == 'financial') {
            $paymentChannels = PaymentChannel::orderBy('created_at', 'desc')->paginate(10);
            $plans=AffliatePlans::get();
            $data['paymentChannels'] = $paymentChannels;
            $data['plans']=$plans;
        }

        return view('admin.settings.' . $page, $data);
    }

    public function personalizationPage(Request $request, $name)
    {
        removeContentLocale();

        $this->authorize('admin_settings_personalization');

        $settings = Setting::where('name', $name)->first();

        $values = null;

        if (!empty($settings)) {
            $defaultLocal = getDefaultLocale();

            if (in_array($name, ['page_background', 'home_sections'])) {
                $defaultLocal = Setting::$defaultSettingsLocale;
            }

            $locale = $request->get('locale', mb_strtolower($defaultLocal));
            storeContentLocale($locale, $settings->getTable(), $settings->id);

            if (!empty($settings->value)) {
                $values = json_decode($settings->value, true);

                $values['locale'] = mb_strtoupper($settings->locale);
            }
        }

        $data = [
            'pageTitle' => trans('oraclepopupsignin/main.settings_title'),
            'values' => $values,
            'name' => $name
        ];

        return view('admin.settings.personalization', $data);
    }

    public function store(Request $request, $name)
    {

        if (!empty($request->get('name'))) {
            $name = $request->get('name');
        }

        $values = $request->get('value', null);

        if (!empty($values)) {
            $locale = $request->get('locale', Setting::$defaultSettingsLocale); // default is "en"

            $values = array_filter($values, function ($val) {
                if (is_array($val)) {
                    return array_filter($val);
                } else {
                    return !empty($val);
                }
            });

            if ($name == 'referral') {
                $getFinancialCommission = getFinancialSettings('commission') ?? 0;

                $validator = Validator::make($values, [
                    'affiliate_user_commission' => 'nullable|numeric|max:' . $getFinancialCommission,
                ]);

                $validator->validate();
            } elseif ($name == 'general') {
                if (empty($values['user_languages']) or !is_array($values['user_languages'])) {
                    $values['content_translate'] = false;
                }
            }

            $values = json_encode($values);
            $values = str_replace('record', rand(1, 600), $values);

            $settings = Setting::updateOrCreate(
                ['name' => $name],
                [
                    'page' => $request->get('page', 'other'),
                    'updated_at' => time(),
                ]
            );

            SettingTranslation::updateOrCreate(
                [
                    'setting_id' => $settings->id,
                    'locale' => mb_strtolower($locale)
                ],
                [
                    'value' => $values,
                ]
            );

            cache()->forget('settings.' . $name);

            if ($name == 'general') {
                cache()->forget('settings.getDefaultLocale');
            }
        }

        return back();
    }

    public function storeSeoMetas(Request $request)
    {
        $name = Setting::$seoMetasName;

        $this->authorize('admin_settings_seo');

        $data = $request->all();
        $locale = $request->get('locale', Setting::$defaultSettingsLocale);
        $newValues = $data['value'];
        $values = [];
        $settings = Setting::where('name', $name)->first();

        if (!empty($settings) and !empty($settings->value)) {
            $values = json_decode($settings->value);
        }

        if (!empty($newValues) and !empty($values)) {
            foreach ($newValues as $newKey => $newValue) {
                foreach ($values as $key => $value) {
                    if ($key == $newKey) {
                        $values->$key = $newValue;
                        unset($newValues[$key]);
                    }
                }
            }
        }

        if (!empty($newValues)) {
            $values = array_merge((array)$values, $newValues);
        }

        $settings = Setting::updateOrCreate(
            ['name' => $name],
            [
                'page' => 'seo',
                'updated_at' => time(),
            ]
        );

        SettingTranslation::updateOrCreate(
            [
                'setting_id' => $settings->id,
                'locale' => mb_strtolower($locale)
            ],
            [
                'value' => json_encode($values),
            ]
        );

        cache()->forget('settings.' . $name);

        return back();
    }

    public function editSocials($social_key)
    {
        removeContentLocale();

        $this->authorize('admin_settings_general');
        $settings = Setting::where('name', Setting::$socialsName)->first();

        if (!empty($settings)) {
            $values = json_decode($settings->value);

            foreach ($values as $key => $value) {
                if ($key == $social_key) {
                    $data = [
                        'pageTitle' => trans('oraclepopupsignin/pages/setting.settings_socials'),
                        'social' => $value,
                        'socialKey' => $social_key,
                    ];

                    return view('admin.settings.general', $data);
                }
            }
        }

        abort(404);
    }

    public function deleteSocials($social_key, $locale = null)
    {
        $this->authorize('admin_settings_general');
        $settings = Setting::where('name', Setting::$socialsName)->first();

        if (empty($locale)) {
            $locale = Setting::$defaultSettingsLocale;
        }

        if (!empty($settings)) {
            $values = json_decode($settings->value);
            foreach ($values as $key => $value) {
                if ($key == $social_key) {
                    unset($values->$social_key);
                }
            }

            $settings = Setting::updateOrCreate(
                ['name' => Setting::$socialsName],
                [
                    'page' => 'general',
                    'updated_at' => time(),
                ]
            );

            SettingTranslation::updateOrCreate(
                [
                    'setting_id' => $settings->id,
                    'locale' => mb_strtolower($locale)
                ],
                [
                    'value' => json_encode($values),
                ]
            );

            cache()->forget('settings.' . Setting::$socialsName);

            return redirect('/oraclepopupsignin/settings/general');
        }

        abort(404);
    }

    public function storeSocials(Request $request)
    {
        $this->authorize('admin_settings_general');
        $this->validate($request, [
            'value.*' => 'required',
        ]);

        $data = $request->all();
        $locale = $request->get('locale', Setting::$defaultSettingsLocale);
        $social = $data['social'];
        $values = [];

        $settings = Setting::where('name', Setting::$socialsName)->first();

        if ($social !== 'newSocial') {
            if (!empty($settings) and !empty($settings->value)) {
                $values = json_decode($settings->value);
                foreach ($values as $key => $value) {
                    if ($key == $social) {
                        $values->$key = $data['value'];
                    }
                }
            }
        } else {
            if (!empty($settings) and !empty($settings->value)) {
                $values = json_decode($settings->value);
            }
            $key = str_replace(' ', '_', $data['value']['title']);
            $newValue[$key] = $data['value'];
            $values = array_merge((array)$values, $newValue);
        }

        $settings = Setting::updateOrCreate(
            ['name' => Setting::$socialsName],
            [
                'page' => 'general',
                'updated_at' => time(),
            ]
        );

        SettingTranslation::updateOrCreate(
            [
                'setting_id' => $settings->id,
                'locale' => mb_strtolower($locale)
            ],
            [
                'value' => json_encode($values),
            ]
        );

        cache()->forget('settings.' . Setting::$socialsName);

        return redirect('/oraclepopupsignin/settings/general');
    }

    public function storeCustomCssJs(Request $request)
    {
        $this->authorize('admin_settings_customization');

        $newValues = $request->get('value', null);
        $locale = $request->get('locale', Setting::$defaultSettingsLocale);
        $values = [];
        $settings = Setting::where('name', Setting::$customCssJsName)->first();

        if (!empty($settings) and !empty($settings->value)) {
            $values = json_decode($settings->value);
        }

        if (!empty($newValues) and !empty($values)) {
            foreach ($newValues as $newKey => $newValue) {
                foreach ($values as $key => $value) {
                    if ($key == $newKey) {
                        $values->$key = $newValue;
                        unset($newValues[$key]);
                    }
                }
            }
        }

        if (!empty($newValues)) {
            $values = array_merge((array)$values, $newValues);
        }

        if (!empty($values)) {
            $values = json_encode($values);

            $settings = Setting::updateOrCreate(
                ['name' => Setting::$customCssJsName],
                [
                    'page' => 'customization',
                    'updated_at' => time(),
                ]
            );

            SettingTranslation::updateOrCreate(
                [
                    'setting_id' => $settings->id,
                    'locale' => mb_strtolower($locale)
                ],
                [
                    'value' => $values,
                ]
            );

            cache()->forget('settings.' . Setting::$customCssJsName);

            return back();
        }
    }

    public function notificationsMetas(Request $request)
    {
        $this->authorize('admin_settings_notifications');
        $name = 'notifications';
        $values = $request->get('value', []);
        $locale = $request->get('locale', Setting::$defaultSettingsLocale);

        $settings = Setting::where('name', $name)->first();

        if (!empty($settings) and !empty($settings->value)) {
            $oldValues = json_decode($settings->value, true);

            $values = array_merge($oldValues, $values);
        }

        if (!empty($values)) {
            $values = array_filter($values);
            $values = json_encode($values);

            $settings = Setting::updateOrCreate(
                ['name' => $name],
                [
                    'page' => 'notifications',
                    'updated_at' => time(),
                ]
            );

            SettingTranslation::updateOrCreate(
                [
                    'setting_id' => $settings->id,
                    'locale' => mb_strtolower($locale)
                ],
                [
                    'value' => $values,
                ]
            );

            cache()->forget('settings.' . $name);
        }

        return back();
    }

    public function addNewAffliatePlan(Request $request)
    {
        // Log::info("funcation called");
        // $this->validate($request, [
        //     'rank' => 'required|min:1|max:80',
        //     'label' => 'required|min:1|max:80',
        //     'Description' => 'required',
        //     'rank_amount_type' => 'required|min:1|max:80',
        //     'direct_commi' => 'required|min:1|max:80',
        //     'partner_commi' => 'required|min:1|max:80',
        //     'rank_color' => 'required|min:1|max:80',
        //     'icon'=>'required',
        // ]);
        // Log::info("validation done");
        $count=AffliatePlans::where(['rank'=>$request->rank, 'label'=>$request->label])->count();
        if($count>0){
            return back()->with('failed', 'Same plan name already used');
        }
        $result=AffliatePlans::create([
            'rank' => $request->rank,
            'label' => $request->label,
            'Description' => $request->description,
            'rank_amount_type' => $request->rank_amount_type,
            'direct_commi' => $request->direct_commi,
            'partner_commi' => $request->partner_commi,
            'rank_color' => $request->rank_color,
            'icon'=>$request->icon,
            'created_at'=>time()
        ]);
        if($result){
            return back()->with('success', 'New affiliate plan has been added');
        }else{
            return back()->with('error', 'Something went wrong try again!');
        }

       

    }

    public function updateAffliatePlan(Request $request)
    {
        $count=AffliatePlans::
        where(['rank'=>$request->rank, 'label'=>$request->label])->where('id','!=',$request->itemID)->count();
        if($count>0){
            return back()->with('failed', 'Same plan name already used');
        }
        if(isset($request->value)){
            $status=1;
        }else{
            $status=0;
        }
        $result=AffliatePlans::where('id', $request->itemID)->update([
            'rank' => $request->rank,
            'label' => $request->label,
            'Description' => $request->description,
            'rank_amount_type' => $request->rank_amount_type,
            'direct_commi' => $request->direct_commi,
            'partner_commi' => $request->partner_commi,
            'rank_color' => $request->rank_color,
            'icon'=>$request->icon,
            'status'=>$status
        ]);
        if($result){
            return back()->with('success', 'Affiliate plan details has been update');
        }else{
            return back()->with('error', 'Something went wrong try again!');
        }
    }

    public function deleteAffliatePlan($id)
    {
        $result=AffliatePlans::where('id', $id)->delete();
        if($result){
            return back()->with('success', 'Affiliate plan has been deleted');
        }else{
            return back()->with('error', 'Something went wrong try again!');
        }
    }
}
