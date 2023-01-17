<?php

namespace webit_be\developer_alert\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
  use HasFactory;

  protected $fillable = ['error_message', 'where_from', 'file', 'stack_trace', 'is_disabled', 'times_throwed', 'snoozed_until'];

  public static function checkIfAlertExists($message, $file)
  {
    return Alert::where('error_message', $message)->where('file', $file)->exists();
  }
}