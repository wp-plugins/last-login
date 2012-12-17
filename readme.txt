=== Last Login ===
Contributors: jboydston, dkukral, Droyal
Donate link: 
Tags: login
Requires at least: 3.0
Tested up to: 3.3.1
Stable tag: 1.0

Plugin for WordPress that records the last time a user logged in and provides a function to display that date.

== Description ==

Records logins and provides a function to display the timestamp. 

== License ==
Copyright 2010 - 2012 Joe Boydston, Don Kukral

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

== Installation ==

Copy "last-login" folder to your WordPress Plugins Directory. 
Activate plugin via WordPress settings.

== Other Notes ==

None. 

== Screenshots ==

None.

== Changelog ==

= 0.0 = 
Initial Version


== Frequently Asked Questions ==

= How do I display the last login of the current user? =

&lt;php echo get_last_login_current_user(); %gt;

= How do I display the last login of a specific user? =

&lt;php echo get_last_login($user_id); %gt;

= How do I change the date format of the last login time? =

You can pass the format to either last_login_time_current_user() or last_login_time() functions.

Use standard PHP strftime format parameters.
(http://php.net/manual/en/function.strftime.php)

&lt;php echo get_last_login_current_user($format); %gt;
&lt;php echo get_last_login($user_id, $format); %gt;

= How can I see if the user has a recorded timestamp? (has logged in since plugin activated) =

You can call check_last_login($user_id) or check_last_login_current_user().

It will return true if a login has been recorded and false if not.

== Upgrade Notice ==

None.
