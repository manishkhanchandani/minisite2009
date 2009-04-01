 CREATE TABLE IF NOT EXISTS `smsreminders` (
`rid` int( 11 ) NOT NULL AUTO_INCREMENT ,
`id` int( 11 ) NOT NULL default '0',
`user_id` int( 11 ) NOT NULL default '0',
`title` varchar( 50 ) default NULL ,
`message` varchar( 160 ) default NULL ,
`tophone` text,
`senddate` int( 11 ) default NULL ,
`smstype` enum( 'Fixed', 'Recurring' ) default NULL ,
`smsdatetime` datetime default NULL ,
`recurringtype` enum( 'Every 10 Minutes', 'Every Half Hourly', 'Hourly', 'Every 2 Hour', 'Every 3 Hours', 'Every 6 Hours', 'Daily', 'WeekDays', 'Sunday', 'SatSun', 'Fortnight', 'Monthly', 'Quarterly', 'SixMonthly', 'Yearly', 'Fixed' ) default NULL ,
`recurringfixedtypedates` text,
`created` datetime default NULL ,
`modified` datetime default NULL ,
`status` int( 2 ) default NULL ,
`lastsenddate` datetime default NULL ,
PRIMARY KEY ( `rid` )
) ENGINE = MYISAM 