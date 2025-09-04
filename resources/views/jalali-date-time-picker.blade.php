@php
    use Filament\Support\Facades\FilamentView;

    $fieldWrapperView = $getFieldWrapperView();
    $datalistOptions = $getDatalistOptions();
    $disabledDates = $getDisabledDates();
    $extraAlpineAttributes = $getExtraAlpineAttributes();
    $extraAttributeBag = $getExtraAttributeBag();
    $extraInputAttributeBag = $getExtraInputAttributeBag();
    $hasTime = $hasTime();
    $id = $getId();
    $isDisabled = $isDisabled();
    $isAutofocused = $isAutofocused();
    $isPrefixInline = $isPrefixInline();
    $isSuffixInline = $isSuffixInline();
    $maxDate = $getMaxDate();
    $minDate = $getMinDate();
    $prefixActions = $getPrefixActions();
    $prefixIcon = $getPrefixIcon();
    $prefixIconColor = $getPrefixIconColor();
    $prefixLabel = $getPrefixLabel();
    $suffixActions = $getSuffixActions();
    $suffixIcon = $getSuffixIcon();
    $suffixIconColor = $getSuffixIconColor();
    $suffixLabel = $getSuffixLabel();
    $statePath = $getStatePath();
    $placeholder = $getPlaceholder();
    $isReadOnly = $isReadOnly();
    $isRequired = $isRequired();
    $isConcealed = $isConcealed();
    $step = $getStep();
    $type = $getType();
    $livewireKey = $getLivewireKey();

    // Persian specific variables
    $months = trans('filament-jalali::months');
    $dayLabels = trans('filament-jalali::days.long');
    $dayShortLabels = trans('filament-jalali::days.short');
@endphp

<x-dynamic-component
        :component="$fieldWrapperView"
        :field="$field"
        :inline-label-vertical-alignment="\Filament\Support\Enums\VerticalAlignment::Center"
>
    <x-filament::input.wrapper
            :disabled="$isDisabled"
            :inline-prefix="$isPrefixInline"
            :inline-suffix="$isSuffixInline"
            :prefix="$prefixLabel"
            :prefix-actions="$prefixActions"
            :prefix-icon="$prefixIcon"
            :prefix-icon-color="$prefixIconColor"
            :suffix="$suffixLabel"
            :suffix-actions="$suffixActions"
            :suffix-icon="$suffixIcon"
            :suffix-icon-color="$suffixIconColor"
            :valid="! $errors->has($statePath)"
            :attributes="\Filament\Support\prepare_inherited_attributes($extraAttributeBag)->class(['fi-fo-date-time-picker'])"
    >
        @if ($isNative())
            <input
                    {{
                        $extraInputAttributeBag
                            ->merge($extraAlpineAttributes, escape: false)
                            ->merge([
                                'autofocus' => $isAutofocused,
                                'disabled' => $isDisabled,
                                'id' => $id,
                                'list' => $datalistOptions ? $id . '-list' : null,
                                'max' => $hasTime ? $maxDate : ($maxDate ? \Carbon\Carbon::parse($maxDate)->toDateString() : null),
                                'min' => $hasTime ? $minDate : ($minDate ? \Carbon\Carbon::parse($minDate)->toDateString() : null),
                                'placeholder' => $placeholder,
                                'readonly' => $isReadOnly,
                                'required' => $isRequired && (! $isConcealed),
                                'step' => $step,
                                'type' => $type,
                                $applyStateBindingModifiers('wire:model') => $statePath,
                                'x-data' => count($extraAlpineAttributes) ? '{}' : null,
                            ], escape: false)
                            ->class([
                                'fi-input',
                                'fi-input-has-inline-prefix' => $isPrefixInline && (count($prefixActions) || $prefixIcon || filled($prefixLabel)),
                                'fi-input-has-inline-suffix' => $isSuffixInline && (count($suffixActions) || $suffixIcon || filled($suffixLabel)),
                            ])
                    }}
            />
        @else
            <div
                    @if (FilamentView::hasSpaMode())
                        {{-- format-ignore-start --}}x-load="visible || event (ax-modal-opened)"{{-- format-ignore-end --}}
                    @else
                        x-load
                    @endif
                    x-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('filament-jalali', 'mokhosh/filament-jalali') }}"
                    x-data="filamentJalaliFormComponent({
                    defaultFocusedDate: @js($defaultFocusedDate),
                    displayFormat: '{{ convert_date_format($getDisplayFormat())->to('day.js') }}',
                    firstDayOfWeek: {{ $getFirstDayOfWeek() }},
                    isAutofocused: @js($isAutofocused),
                    locale: @js($getLocale()),
                    shouldCloseOnDateSelection: @js($shouldCloseOnDateSelection()),
                    state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$statePath}')") }},
                    months: @js($months),
                    dayLabel: @js($dayLabels),
                    dayShortLabel: @js($dayShortLabels)
                })"
                    wire:ignore
                    wire:key="{{ $livewireKey }}.{{
                    substr(md5(serialize([
                        $disabledDates,
                        $isDisabled,
                        $isReadOnly,
                        $maxDate,
                        $minDate,
                    ])), 0, 64)
                }}"
                    x-on:keydown.esc="isOpen() && $event.stopPropagation()"
                    {{
                        $attributes
                            ->merge($getExtraAttributes(), escape: false)
                            ->merge($getExtraAlpineAttributes(), escape: false)
                            ->class(['fi-fo-date-time-picker'])
                    }}
            >
                <input x-ref="maxDate" type="hidden" value="{{ $maxDate }}" />

                <input x-ref="minDate" type="hidden" value="{{ $minDate }}" />

                <input
                        x-ref="disabledDates"
                        type="hidden"
                        value="{{ json_encode($disabledDates) }}"
                />

                <button
                        x-ref="button"
                        x-on:click="togglePanelVisibility()"
                        x-on:keydown.enter.stop.prevent="
                        if (! $el.disabled) {
                            isOpen() ? selectDate() : togglePanelVisibility()
                        }
                    "
                        x-on:keydown.arrow-left.stop.prevent="if (! $el.disabled) focusNextDay()"
                        x-on:keydown.arrow-right.stop.prevent="if (! $el.disabled) focusPreviousDay()"
                        x-on:keydown.arrow-up.stop.prevent="if (! $el.disabled) focusPreviousWeek()"
                        x-on:keydown.arrow-down.stop.prevent="if (! $el.disabled) focusNextWeek()"
                        x-on:keydown.backspace.stop.prevent="if (! $el.disabled) clearState()"
                        x-on:keydown.clear.stop.prevent="if (! $el.disabled) clearState()"
                        x-on:keydown.delete.stop.prevent="if (! $el.disabled) clearState()"
                        aria-label="{{ $placeholder }}"
                        type="button"
                        tabindex="-1"
                        @disabled($isDisabled || $isReadOnly)
                        {{
                            $getExtraTriggerAttributeBag()->class([
                                'fi-fo-date-time-picker-trigger w-full',
                            ])
                        }}
                >
                    <input
                            @disabled($isDisabled)
                            readonly
                            placeholder="{{ $placeholder }}"
                            wire:key="{{ $livewireKey }}.display-text"
                            x-model="displayText"
                            dir="ltr"
                            @if ($id = $getId()) id="{{ $id }}" @endif
                            @class([
                                'fi-fo-date-time-picker-display-text-input w-full border-none bg-transparent px-3 py-1.5 text-base text-gray-950 outline-none transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] sm:text-sm sm:leading-6',
                            ])
                    />
                </button>

                <div
                        x-ref="panel"
                        x-cloak
                        x-float.placement.bottom-start.offset.flip.shift="{ offset: 8 }"
                        wire:ignore
                        wire:key="{{ $livewireKey }}.panel"
                        @class([
                            'fi-fo-date-time-picker-panel absolute z-10 rounded-lg bg-white p-4 shadow-lg ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10',
                        ])
                >
                        @if ($hasDate())
                            <div class="fi-fo-date-time-picker-panel-header">
                                <select
                                        x-model="focusedMonth"
                                        class="fi-fo-date-time-picker-month-select grow cursor-pointer border-none bg-transparent p-0 text-sm font-medium text-gray-950 focus:ring-0 dark:bg-gray-900 dark:text-white"
                                >
                                    <template x-for="(month, index) in months">
                                        <option
                                                x-bind:value="index"
                                                x-text="month"
                                        ></option>
                                    </template>
                                </select>

                                <input
                                        type="number"
                                        inputmode="numeric"
                                        x-model.debounce="focusedYear"
                                        class="fi-fo-date-time-picker-year-input w-16 border-none bg-transparent p-0 text-right text-sm text-gray-950 focus:ring-0 dark:text-white"
                                />
                            </div>

                            <div class="fi-fo-date-time-picker-calendar-header grid grid-cols-7 gap-1">
                                <template x-for="(day, index) in dayLabels" x-bind:key="index">
                                    <div
                                            x-text="day"
                                            class="fi-fo-date-time-picker-calendar-header-day text-center text-xs font-medium text-gray-500 dark:text-gray-400"
                                    ></div>
                                </template>
                            </div>

                            <div
                                    role="grid"
                                    class="fi-fo-date-time-picker-calendar grid grid-cols-[repeat(7,minmax(theme(spacing.7),1fr))] gap-1"
                            >
                                <template
                                        x-for="day in emptyDaysInFocusedMonth"
                                        x-bind:key="day">
                                    <div></div>
                                </template>

                                <template
                                        x-for="day in daysInFocusedMonth"
                                          x-bind:key="day"
                                >
                                    <div
                                            x-text="day"
                                            x-on:click="dayIsDisabled(day) || selectDate(day)"
                                            x-on:mouseenter="setFocusedDay(day)"
                                            role="option"
                                            x-bind:aria-selected="focusedDate.date() === day"
                                            x-bind:class="{
                                            'text-gray-950 dark:text-white': ! dayIsToday(day) && ! dayIsSelected(day),
                                            'cursor-pointer': ! dayIsDisabled(day),
                                            'text-primary-600 dark:text-primary-400 fi-fo-date-time-picker-calendar-day-today':
                                            dayIsToday(day) &&
                                             ! dayIsSelected(day) &&
                                              focusedDate.date() !== day &&
                                               ! dayIsDisabled(day),
                                            'bg-gray-50 dark:bg-white/5':
                                             focusedDate.date() === day &&
                                              ! dayIsSelected(day) &&
                                               ! dayIsDisabled(day),
                                            'text-primary-600 bg-gray-50 dark:bg-white/5 dark:text-primary-400 fi-selected':
                                             dayIsSelected(day),
                                            'pointer-events-none': dayIsDisabled(day),
                                            'opacity-50': dayIsDisabled(day),
                                        }"
                                            class="fi-fo-date-time-picker-calendar-day rounded-full text-center text-sm leading-loose transition duration-75"
                                    ></div>
                                </template>
                            </div>
                        @endif

                        @if ($hasTime)
                            <div class="fi-fo-date-time-picker-time-inputs flex items-center justify-center rtl:flex-row-reverse">
                                <input
                                        max="23"
                                        min="0"
                                        step="{{ $getHoursStep() }}"
                                        type="number"
                                        inputmode="numeric"
                                        x-model.debounce="hour"
                                        class="fi-fo-date-time-picker-time-input me-1 w-10 border-none bg-transparent p-0 text-center text-sm text-gray-950 focus:ring-0 dark:text-white"
                                />

                                <span class="fi-fo-date-time-picker-time-input-separator text-sm font-medium text-gray-500 dark:text-gray-400">
                                    :
                                </span>

                                <input
                                        max="59"
                                        min="0"
                                        step="{{ $getMinutesStep() }}"
                                        type="number"
                                        inputmode="numeric"
                                        x-model.debounce="minute"
                                        class="fi-fo-date-time-picker-time-input me-1 w-10 border-none bg-transparent p-0 text-center text-sm text-gray-950 focus:ring-0 dark:text-white"
                                />

                                @if ($hasSeconds())
                                    <span class="fi-fo-date-time-picker-time-input-separator text-sm font-medium text-gray-500 dark:text-gray-400">
                                        :
                                    </span>

                                    <input
                                            max="59"
                                            min="0"
                                            step="{{ $getSecondsStep() }}"
                                            type="number"
                                            inputmode="numeric"
                                            x-model.debounce="second"
                                            class="fi-fo-date-time-picker-time-input me-1 w-10 border-none bg-transparent p-0 text-center text-sm text-gray-950 focus:ring-0 dark:text-white"
                                    />
                                @endif
                            </div>
                        @endif
                </div>
            </div>
        @endif
    </x-filament::input.wrapper>

    @if ($datalistOptions)
        <datalist id="{{ $id }}-list">
            @foreach ($datalistOptions as $option)
                <option value="{{ $option }}" />
            @endforeach
        </datalist>
    @endif
</x-dynamic-component>