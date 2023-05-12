<?php

namespace webit_be\developer_alert\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use webit_be\developer_alert\Models\Prompt;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Alert extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = ['error_message', 'where_from', 'function', 'stack_trace', 'status', 'is_disabled', 'times_throwed', 'snoozed_until'];

  public static function checkIfAlertExists($message, $where_from, $function)
  {
    return Alert::where('error_message', $message)->where('where_from', $where_from)->where('function', $function)->exists();
  }

  public function prompt(): hasMany
  {
    return $this->hasMany(Prompt::class);
  }
}