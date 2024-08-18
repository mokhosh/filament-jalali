# How to sync this
Since I have made as little change as possible to the original Filament component, this should look and feel just like the original.
If there's ever a change in the original component, these are the changes I've made, for my own future reference.
Latest sync: Aug 23

## In the component js file

Customize the [original](https://github.com/filamentphp/filament/blob/3.x/packages/forms/resources/js/components/date-time-picker.js)

```diff
+import jalaliday from 'jalaliday'

 dayjs.extend(customParseFormat)
 dayjs.extend(localeData)
 dayjs.extend(timezone)
 dayjs.extend(utc)

+dayjs.extend(jalaliday)
+dayjs.calendar('jalali')
```

```diff
         init: function () {
-            dayjs.locale(locales[locale] ?? locales['en'])
-
+            dayjs.locale(locale ?? 'en')
             this.focusedDate = dayjs().tz(timezone)
```

```diff
         setMonths: function () {
-            this.months = dayjs.months()
+            this.months = dayjs.locale() === 'en' ?
+                dayjs.en.jmonths :
+                'فروردین_اردیبهشت_خرداد_تیر_مرداد_شهریور_مهر_آبان_آذر_دی_بهمن_اسفند'.split('_')
         },
```

```diff
             this.state = date
+                .calendar('gregory')
                 .hour(this.hour ?? 0)
```

```diff
-const locales = {
-    ar: require('dayjs/locale/ar'),
-    bs: require('dayjs/locale/bs'),
-    ca: require('dayjs/locale/ca'),
-    cs: require('dayjs/locale/cs'),
-    cy: require('dayjs/locale/cy'),
-    da: require('dayjs/locale/da'),
-    de: require('dayjs/locale/de'),
-    en: require('dayjs/locale/en'),
-    es: require('dayjs/locale/es'),
-    fa: require('dayjs/locale/fa'),
-    fi: require('dayjs/locale/fi'),
-    fr: require('dayjs/locale/fr'),
-    hi: require('dayjs/locale/hi'),
-    hu: require('dayjs/locale/hu'),
-    hy: require('dayjs/locale/hy-am'),
-    id: require('dayjs/locale/id'),
-    it: require('dayjs/locale/it'),
-    ja: require('dayjs/locale/ja'),
-    ka: require('dayjs/locale/ka'),
-    km: require('dayjs/locale/km'),
-    ku: require('dayjs/locale/ku'),
-    ms: require('dayjs/locale/ms'),
-    my: require('dayjs/locale/my'),
-    nl: require('dayjs/locale/nl'),
-    pl: require('dayjs/locale/pl'),
-    pt_BR: require('dayjs/locale/pt-br'),
-    pt_PT: require('dayjs/locale/pt'),
-    ro: require('dayjs/locale/ro'),
-    ru: require('dayjs/locale/ru'),
-    sv: require('dayjs/locale/sv'),
-    tr: require('dayjs/locale/tr'),
-    uk: require('dayjs/locale/uk'),
-    vi: require('dayjs/locale/vi'),
-    zh_CN: require('dayjs/locale/zh-cn'),
-    zh_TW: require('dayjs/locale/zh-tw'),
-}
```

## In the component blade file

Customize the [original](https://github.com/filamentphp/filament/blob/3.x/packages/forms/resources/views/components/date-time-picker.blade.php)

```diff
-        @if ($isNative())
-            <x-filament::input
-                :attributes="
-                    $getExtraInputAttributeBag()
-                        ->merge($extraAlpineAttributes, escape: false)
-                        ->merge([
-                            'autofocus' => $isAutofocused(),
-                            'disabled' => $isDisabled,
-                            'id' => $id,
-                            'inlinePrefix' => $isPrefixInline && (count($prefixActions) || $prefixIcon || filled($prefixLabel)),
-                            'inlineSuffix' => $isSuffixInline && (count($suffixActions) || $suffixIcon || filled($suffixLabel)),
-                            'list' => $datalistOptions ? $id . '-list' : null,
-                            'max' => (! $isConcealed) ? $getMaxDate() : null,
-                            'min' => (! $isConcealed) ? $getMinDate() : null,
-                            'placeholder' => $getPlaceholder(),
-                            'readonly' => $isReadOnly(),
-                            'required' => $isRequired() && (! $isConcealed),
-                            'step' => $getStep(),
-                            'type' => $getType(),
-                            $applyStateBindingModifiers('wire:model') => $statePath,
-                            'x-data' => count($extraAlpineAttributes) ? '{}' : null,
-                        ], escape: false)
-                "
-            />
-        @else
```

```diff
             <div
                 x-ignore
                 ax-load
-                ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('date-time-picker', 'filament/forms') }}"
+                ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('jalali-date-time-picker', 'mokhosh/filament-jalali') }}"
```

```diff
-                    x-on:keydown.arrow-left.stop.prevent="if (! $el.disabled) focusPreviousDay()"
-                    x-on:keydown.arrow-right.stop.prevent="if (! $el.disabled) focusNextDay()"
+                    x-on:keydown.arrow-left.stop.prevent="if (! $el.disabled) focusNextDay()"
+                    x-on:keydown.arrow-right.stop.prevent="if (! $el.disabled) focusPreviousDay()"
```

```diff
                     </div>
                 </div>
             </div>
-        @endif
```
