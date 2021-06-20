# Astrology Project
An astrology project based upon sweph.

This astrology software displays planetary bodies on a horizontal graph. It is possible to choose a planetary body, and display it on a certain selected timeline, ranging from 2000 BC to 2100 AD. This gives a clear calculation to see when a planet was in a certain sign.

# Databases
This Astrology project uses pre-calculated positions of planetrary bodies. In this way, we can use simple SQL queries to retrieve certain data. We used the Astro.com Sweph output, to calculate the bodies based upon Month, Years and the Houses. There are 3 zip files containing the databases with the calculated planetary bodies. These need to be extracted, and added into a database in order to query them through the PHP files. The database requires at least 40MB, the SQL tables are zipped for Github, because of the size of the computations.

# Structure

	CREATE TABLE `astrology_years` (
	  `id` int(11) NOT NULL,
	  `planet` varchar(255) NOT NULL,
	  `sign` varchar(255) NOT NULL,
	  `deg` varchar(255) NOT NULL,
	  `min` varchar(255) NOT NULL,
	  `sec` varchar(255) NOT NULL,
	  `year` int(11) NOT NULL,
	  `retrograde` int(2) NOT NULL
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;

	CREATE TABLE `astrology_months` (
	  `id` int(11) NOT NULL,
	  `planet` varchar(4) NOT NULL,
	  `sign` varchar(4) NOT NULL,
	  `deg` varchar(4) NOT NULL,
	  `min` varchar(4) NOT NULL,
	  `sec` varchar(4) NOT NULL,
	  `year` int(6) NOT NULL,
	  `month` int(2) NOT NULL,
	  `day` int(2) NOT NULL,
	  `retrograde` int(2) NOT NULL
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;

# Planetary objects

In order to keep the size of the database reasonably limited, there is a limited availablity of calculated planetary objects, the astrology project currently only supports the following objects: 

	- Sun
	- Moon
	- Mercury
	- Venus
	- Mars
	- Jupiter
	- Saturn
	- Uranus
	- Neptune
	- Pluto
	- Chiron
	- Lilith

# Credits
The class is free for use under the GNU v 2.0 license.

# 3rd party license
This class uses 3rd party software: 

- VIS.js for graphics. See VIS license for use, no warranty given.
- noUiSlider. See noUiSlider license for use, no warranty given.
- Database was calculated and populated with astro.com PHP sweph, no warranty given.

# Security
For now, it is not advised to run this software on a live server. Instead, it would be better to run it locally.
