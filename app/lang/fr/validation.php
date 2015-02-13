<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => "Le champ :attribute doit être accepté.",
	"active_url"           => "Le champ :attribute n'est pas une URL valide.",
	"after"                => "Le champ :attribute doit être une date supérieure à :date.",
	"alpha"                => "Le champ :attribute peut seulement contenir des lettres.",
	"alpha_dash"           => "Le champ :attribute peut seulement contenir des lettres, des nombres et   des tirets/underscores.",
	"alpha_num"            => "Le champ :attribute peut seulement contenir des lettres et des nombres",
	"array"                => "Le champ :attribute doit être un tableau.",
	"before"               => "Le champ :attribute doit être une date inférieure à :date.",
	"between"              => array(
		"numeric" => "Le champ :attribute doit être entre :min et :max.",
		"file"    => "Le champ :attribute doit être entre :min et :max kilo-octets.",
		"string"  => "Le champ :attribute doit être entre :min et :max caractères.",
		"array"   => "Le champ :attribute doit être entre :min et :max objets.",
	),
	"boolean"              => "Le champ :attribute doit être vrai ou faux.",
	"confirmed"            => "La confirmation de :attribute ne correspond pas.",
	"date"                 => "Le champ :attribute n'est pas une date valide.",
	"date_format"          => "Le champ :attribute ne correspond pas au format :format.",
	"different"            => "Les champs :attribute et :other doivent être différents.",
	"digits"               => "Le champ :attribute doit être :digits numérique.",
	"digits_between"       => "Le champ :attribute doit être en :min et :max chiffres.",
	"email"                => "Le champ :attribute doit être une adresse valide.",
	"exists"               => "Le champ sélectionné :attribute est invalide.",
	"image"                => "Le champ :attribute doît etre une image.",
	"in"                   => "Le champ sélectionné :attribute est invalide.",
	"integer"              => "Le champ :attribute doit être entier.",
	"ip"                   => "Le champ :attribute doit être une adresse IP valide.",
	"max"                  => array(
		"numeric" => "Le champ :attribute ne doit pas être plus grand que :max.",
		"file"    => "Le champ :attribute ne doit pas être plus grand que :max kilo-octets.",
		"string"  => "Le champ :attribute ne doit pas être plus grand que :max caractères.",
		"array"   => "Le champ :attribute ne doit pas avoir plus de :max objets.",
	),
	"mimes"                => "Le champ :attribute doit être du type: :values.",
	"min"                  => array(
		"numeric" => "Le champ :attribute doit valoir au moins :min.",
		"file"    => "Le champ :attribute doit valoir au moins :min kilo-octets.",
		"string"  => "Le champ :attribute doit valoir au moins :min caractères.",
		"array"   => "Le champ :attribute doit avoir au moins :min objets.",
	),
	"not_in"               => "The selected :attribute est invalide.",
	"numeric"              => "Le champ :attribute doit être un nombre.",
	"regex"                => "Le champ :attribute a un format invalide.",
	"required"             => "Le champ :attribute est requis.",
	"required_if"          => "Le champ :attribute est requis quand :other is :value.",
	"required_with"        => "Le champ :attribute est requis quand :values est présent(e).",
	"required_with_all"    => "Le champ :attribute est requis quand :values est présent(e).",
	"required_without"     => "Le champ :attribute est requis quand :values n'est pas présent(e).",
	"required_without_all" => "Le champ :attribute est requis quand aucunes valeur :values est présente.",
	"same"                 => "Le champ :attribute and :other doivent correspondre.",
	"size"                 => array(
		"numeric" => "Le champ :attribute must be :size.",
		"file"    => "Le champ :attribute must be :size kilobytes.",
		"string"  => "Le champ :attribute must be :size characters.",
		"array"   => "Le champ :attribute must contain :size items.",
	),
	"unique"               => "Le champ :attribute has already been taken.",
	"url"                  => "Le champ :attribute format is invalid.",
	"timezone"             => "Le champ :attribute must be a valid zone.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/e

	'custom' => array(
		'attribute-name' => array(
			'rule-name' => 'custom-message',
		),
	),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),

);
