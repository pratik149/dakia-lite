<?php

namespace App\Enums;

enum FieldType: string
{
	case Text = 'text';
	case Number = 'number';
	case Date = 'date';
	case Boolean = 'boolean';
}
