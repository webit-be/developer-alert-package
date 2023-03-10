<?php

namespace webit_be\developer_alert\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
  use HasFactory;

  protected $fillable = ['error_message', 'where_from', 'function', 'stack_trace', 'is_disabled', 'times_throwed', 'snoozed_until'];

  public static function checkIfAlertExists($message, $where_from, $function)
  {
    return Alert::where('error_message', $message)->where('where_from', $where_from)->where('function', $function)->exists();
  }
}