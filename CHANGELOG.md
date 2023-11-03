# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/)


## [3.0.0] - 2022-01-02
### Changed
- Bump version


## [2.11.18] - 2021-11-15
### Added
- Showing device names in user device management


## [2.11.17] - 2021-11-14
### Added
- Database migration: Add full_name to users table
- Ability to set/change full name for users, closes #16

### Changed
- Do not show calls to s extension for admin users, closes #17

### Fixed
- Fixed bug when it was impossible to modify users


## [2.10.16] - 2021-10-27
### Fixed
- Fixed bug when device_names were not properly populated


## [2.10.15] - 2021-10-27
### Added
- Added new users/index page
- Added new users/edit page
- Added new users/devices page
- Added new users/remove_device page
- Added new users/create page


## [2.9.14] - 2021-09-04
### Fixed
- Fixed issue when call recordings could not be rewinded


## [2.8.13] - 2021-08-32
### Added
- Displaying names for calls
- Database migration: Add show_names fieild for users


## [2.2.2] - 2021-02-13
### Added
- New function add_device_alias for User_model
- Now we can add device aliases from tools command line


## [2.2.1] - 2021-02-08
### Added
- Database update - Users now have can_listen and can_download flags
- Ability to restrict listen and download functionality to users


## [2.1.1] - 2021-01-04
### Changed
- Update copyright
- Minor changes


## [1.12.1] - 2020-12-29
### Added
- qc_get_call_recording_path() now searches for additional call recording locations


## [1.9.1] - 2020-09-12
### Fixed
- Fixed incorrect table definition in UPDATE-1.4.1.sql


## [1.6.1] - 2020-06-15
### Fixed
- Fixed incorrect table defnition in SCHEMA.sql


## [1.4.1] - 2020-03-23
### Added
- New `Device_alias_model`
- New file for database schema update
- New function `User_model->get_device_aliases()`
- If device aliases are set, recordings page show aliases instead of device number

### Changed
- Users can now have 'preudo' devices
- Users can be assigned to pseudo devices

## Fixed
- Fixed SCHEMA.sql to populate proper column for `qc_user_devices.device_id`


## [1.4] - 2019-09-28
### Fixed
- Fixed bug when some recordings were not loaded in player

## [1.3] - 2019-09-28
### Changed
- Reverted QC_AST_SPOOL_PATH to default value

## [1.2] - 2019-09-28
### Changed
- Autoloading user_agent library
- Asterisk spool path is now saved in constants

### Fixed
- Fixed bug when wrong date was specified in calls page
- Fixed bug with incorrect HTTP_HOST setting


## [1.1] - 2019-09-25
### Fixed
- Fixed some unlocalized strings in stats page


## [1.0] - 2019-09-23
### Initial public release
- CLI base (un)install scripts
- Command line based user management
- CDR search, download and playback
- Minimalistic stats abilities
