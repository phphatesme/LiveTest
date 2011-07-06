<?php

namespace Base\Date;

use DateInterval;

class Duration
{
  /**
   * This function returns the formatted duration. Splits the given seconds into minuts and hours.
   *
   * @param int $duration
   */
  public static function format($durationInSeconds, $dayText = '', $hourText = '', $minuteText = '', $secondText = '')
  {
    $seconds = $durationInSeconds % 60;
    $minutes = floor(($durationInSeconds % 3600)/ 60);
    $hours = floor(($durationInSeconds % 86400)/ 3600);
    $days = floor($durationInSeconds / 86400);

    if ($days > 0)
    {
      return sprintf($dayText . $hourText . $minuteText . $secondText, $days, $hours, $minutes, $seconds);
    }

    if ($hours > 0)
    {
      return sprintf($hourText . $minuteText . $secondText, $hours, $minutes, $seconds);
    }

    if ($minutes > 0)
    {
      return sprintf( $minuteText . $secondText, $minutes, $seconds);
    }

    return sprintf( $secondText, $seconds);
  }
}