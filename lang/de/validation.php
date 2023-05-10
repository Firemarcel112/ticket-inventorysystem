<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines FOR EN
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Das :attribute muss akzeptiert werden.',
    'accepted_if' => 'Das :attribute muss akzeptiert werden, wenn :other :value ist.',
    'active_url' => 'Das :attribute ist keine gültige URL.',
    'after' => 'Das :attribute muss ein Datum sein nach dem :date sein.',
    'after_or_equal' => 'Das :attribute muss ein Datum sein nach dem oder gleich :date sein.',
    'alpha' => 'Das :attribute darf nur Buchstaben enthalten.',
    'alpha_dash' => 'Das :attribute darf nur Buchstaben, Nummern, Bindestriche und Unterstriche enthalten.',
    'alpha_num' => 'Das :attribute darf nur Buchstaben und Nummern enthalten.',
    'array' => 'Das :attribute muss ein Array sein.',
    'before' => 'Das :attribute muss ein Datum vor :date sein.',
    'before_or_equal' => 'Das :attribute muss ein Datum vor dem oder gleich :date sein.',
    'between' => [
        'array' => 'Das :attribute muss zwischen :min und :max Elementen enthalten sein.',
        'file' => 'Die Datei :attribute muss zwischen :min und :max Kilobytes groß sein.',
        'numeric' => 'Das :attribute muss zwischen :min und :max sein.',
        'string' => 'Das :attribute muss zwischen :min und :max Zeichen lang sein.',
    ],
    'boolean' => 'Das :attribute Feld muss TRUE oder FALSE sein.',
    'confirmed' => 'Die Bestätigung für :attribute stimmt nicht überein.',
    'current_password' => 'Das Passwort ist falsch.',
    'date' => 'Das :attribute ist kein gültiges Passwort is not a valid date.',
    'date_equals' => 'Das :attribute muss ein Datum sein, das gleich :date ist.',
    'date_format' => 'Das :attribute stimmt nicht mit dem Format :format überein.',
    'declined' => 'Das :attribute muss abgelehnt werden.',
    'declined_if' => 'Das :attribute muss abgelehnt werden, wenn :other ist :value.',
    'different' => 'Das :attribute und :other muss unterschiedlich sein.',
    'digits' => 'Das :attribute muss :digits Ziffern enthalten.',
    'digits_between' => 'Das :attribute muss zwischen :min und :max Ziffern enthalten.',
    'dimensions' => 'Das :attribute hat ein falschen Bildformat.',
    'distinct' => 'Das :attribute Feld hat einen doppelten Wert.',
    'doesnt_end_with' => 'Das :attribute darf nicht mit folgenden Werten enden: :values.',
    'doesnt_start_with' => 'Das :attribute darf nicht mit folgenden Werten anfangen: :values.',
    'email' => 'Das :attribute muss eine gültige E-Mail Adresse sein.',
    'ends_with' => 'Das :attribute muss mit folgenden Werten enden: :values.',
    'enum' => 'Das ausgewählte :attribute ist ungültig.',
    'exists' => 'Das ausgewählte :attribute ist ungültig.',
    'file' => 'Das :attribute muss eine Datei sein.',
    'filled' => 'Das :attribute Feld muss ein Wert haben.',
    'gt' => [
        'array' => 'Das :attribute muss mehr als :value Elemente enthalten.',
        'file' => 'Das :attribute muss größer als :value Kilobytes sein.',
        'numeric' => 'Das :attribute muss größer sein als :value.',
        'string' => 'Das :attribute muss mehr als :value Zeichen enthalten.',
    ],
    'gte' => [
        'array' => 'Das :attribute muss :value Elemente oder mehr haben.',
        'file' => 'Das :attribute muss größer oder gleich :value Kilobytes haben.',
        'numeric' => 'Das :attribute muss größer oder gleich :value sein.',
        'string' => 'Das :attribute muss aus mindestens :value Zeichen enthalten.',
    ],
    'image' => 'Das :attribute muss ein Bild sein.',
    'in' => 'Das ausgewählte :attribute ist ungültig.',
    'in_array' => 'Das :attribute Feld existiert nicht in :other.',
    'integer' => 'Das :attribute muss ein integer (gerade Zahl) sein.',
    'ip' => 'Das :attribute muss eine gültige IP-Adresse sein.',
    'ipv4' => 'Das :attribute muss eine gültige IPv4-Adresse sein.',
    'ipv6' => 'Das :attribute muss eine gültige IPv6-Adresse sein.',
    'json' => 'Das :attribute muss ein gültiger JSON String sein.',
    'lt' => [
        'array' => 'Das :attribute muss weniger als :value Elemente enthalten.',
        'file' => 'Das :attribute muss weniger als :value Kilobytes sein.',
        'numeric' => 'Das :attribute muss weniger sein als :value.',
        'string' => 'Das :attribute muss weniger Zeichen haben als :value.',
    ],
    'lte' => [
        'array' => 'Das :attribute darf nicht mehr als :value Elemente enthalten.',
        'file' => 'Das :attribute muss weniger oder gleich :value Kilobytes haben.',
        'numeric' => 'Das :attribute muss weniger oder gleich :value sein.',
        'string' => 'Das :attribute muss weniger oder gleich :value Zeichen enthalten.',
    ],
    'mac_address' => 'Das :attribute muss eine gültige MAC-Adresse sein.',
    'max' => [
        'array' => 'Das :attribute darf nicht mehr als :max Elemente haben.',
        'file' => 'Das :attribute darf nicht größer als :max Kilobytes sein.',
        'numeric' => 'Das :attribute darf nicht größer sein als :max.',
        'string' => 'Das :attribute darf nicht mehr als :max Zeichen haben.',
    ],
    'max_digits' => 'Das :attribute darf nicht mehr als :max Ziffern haben.',
    'mimes' => 'Das :attribute muss ein Datentyp von :values sein.',
    'mimetypes' => 'Das :attribute muss ein Datentyp von :values sein.',
    'min' => [
        'array' => 'Das :attribute muss mindestens :min Elemente enthalten.',
        'file' => 'Das :attribute muss mindestens :min Kilobytes groß sein.',
        'numeric' => 'Das :attribute muss mindestens :min. sein',
        'string' => 'Das :attribute muss mindestens :min Zeichen enthalten.',
    ],
    'min_digits' => 'Das :attribute muss mindestens :min Ziffern haben.',
    'multiple_of' => 'Das :attribute muss ein Vielfaches von :value sein.',
    'not_in' => 'Das ausgewählte :attribute ist ungültig.',
    'not_regex' => 'Das :attribute Format ist ungültig.',
    'numeric' => 'Das :attribute muss eine Nummer sein.',
    'password' => [
        'letters' => 'Das :attribute muss mindestens einen Buchstaben enthalten.',
        'mixed' => 'Das :attribute muss mindestens einen Großbuchstaben und einen Kleinbuchstaben enthalten.',
        'numbers' => 'Das :attribute muss mindestens ein Zahl enthalten.',
        'symbols' => 'Das :attribute muss mindesten ein Symbol enthalten.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'Das :attribute Feld muss vorhanden sein.',
    'prohibited' => 'Das :attribute Feld ist verboten.',
    'prohibited_if' => 'Das :attribute Feld ist verboten, wenn :other ist :value.',
    'prohibited_unless' => 'Das :attribute Feld ist verboten, außer es ist :other in :values.',
    'prohibits' => 'Das :attribute Feld verbietet, :other, wenn es vorhanden ist.',
    'regex' => 'Das :attribute Format ist ungültig.',
    'required' => 'Das :attribute Feld ist erforderlich.',
    'required_array_keys' => 'Das :attribute Feld muss Einträge enthalten für: :values.',
    'required_if' => 'Das :attribute Feld ist erforderlich, wenn :other :value ist.',
    'required_unless' => 'Das :attribute Feld ist erforderlich, außer :other isin in :values enthalten.',
    'required_with' => 'Das :attribute Feld ist erforderlich, wenn :values vorhanden ist.',
    'required_with_all' => 'Das :attribute Feld ist erforderlich, wenn :values vorhanden sind.',
    'required_without' => 'Das :attribute Feld ist erforderlich, wenn :values nicht vorhanden ist.',
    'required_without_all' => 'Das :attribute Feld ist erforderlich, wenn keines der :values vorhanden ist.',
    'same' => 'Das :attribute und :other müssen miteinander übereinstimmen.',
    'size' => [
        'array' => 'Das :attribute muss :size Elemente enthalten.',
        'file' => 'Die Datei :attribute muss :size Kilobytes groß sein.',
        'numeric' => 'Der Wert von :attribute muss :size sein.',
        'string' => 'Das :attribute muss :size Zeichen lang sein.',
    ],
    'starts_with' => 'Das :attribute muss mit einem der folgenden Werte beginnen: :values.',
    'string' => 'Das :attribute muss ein string sein.',
    'timezone' => 'Das :attribute muss eine gültige Zeitzone sein.',
    'unique' => 'Das :attribute ist bereits vergeben.',
    'uploaded' => 'Das :attribute konnte nicht hochgeladen werden.',
    'url' => 'Das :attribute muss eine gültige URL sein.',
    'uuid' => 'Das :attribute muss eine gültige UUID sein.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
