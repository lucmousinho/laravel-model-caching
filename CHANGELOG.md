# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [0.2.23] - 13 Feb 2018
### Fixed
- whereBetween and value bindings parsing.

## [0.2.22] - 10 Feb 2018
### Fixed
- Laravel 5.5 dependencies.

## [0.2.21] - 9 Feb 2018
### Added
- Laravel 5.6 compatibility.

## [0.2.20] - 7 Feb 2018
### Fixed
- previously existing unit tests to properly consider changes made in 0.2.19.

## [0.2.19] - 7 Feb 2018
### Fixed
- parsing of where clause operators.

## [0.2.18] - 16 Jan 2018
### Added
- hashing of cache keys to prevent key length over-run issues.

### Updated
- dependency version constraint for "pretty test printer".

## [0.2.17] - 10 Jan 2018
###Added
- caching for value() querybuilder method.

### Updated
- tests to use Orchestral Testbench.

## [0.2.16] - 5 Jan 2018
### Added
- `thanks` package.

### Updated
- readme explaining `thanks` package.

## [0.2.15] - 30 Dec 2017
### Added
- sanity checks for artisan command with feedback as to what needs to be fixed.

## [0.2.14] - 30 Dec 2017
### Added
- ability to flush cache for a given model via Artisan command.

## [0.2.13] - 28 Dec 2017
### Added
- ability to define custom cache store in `.env` file.

## [0.2.12] - 14 Dec 2017
### Added
- chainable method to disable caching of queries.

## [0.2.11] - 13 Dec 2017
### Added
- functionality to clear corresponding cache tags when model is deleted.

## [0.2.10] - 5 Dec 2017
### Fixed
- caching when using `orderByRaw()`.

## [0.2.9] - 19 Nov 2017
### Added
- test for query scopes.
- test for relationship query.

### Updated
- readme file.
- travis configuration.

## [0.2.8] - 2017-10-17
### Updated
- code with optimizations and refactoring.

## [0.2.7] - 2017-10-16
### Added
- remaining unit tests that were incomplete, thanks everyone who participated!
- added parsing of where `doesnthave()` condition.

## [0.2.6] - 2017-10-12
### Added
- orderBy clause to cache key. Thanks @RobMKR for the PR!

## [0.2.5] - 2017-10-04
### Fixed
- parsing of nested, exists, raw, and column where clauses.

## [0.2.4] - 2017-10-03
### Added
- .gitignore file to reduce download size for production environment.

### Fixed
- parsing of where clauses with null and notnull.

## [0.2.3] - 2017-10-03
### Fixed
- parsing of where clauses to account for some edge cases.

## [0.2.2] - 2017-09-29
### Added
- additional unit tests for checking caching of lazy-loaded relationships.

### Fixed
- generation of cache key for queries with where clauses.

## [0.2.1] - 2017-09-25
### Fixed
- where clause parsing when where clause is empty.

## [0.2.0] - 2017-09-24
### Changed
- approach to caching things. Completely rewrote the CachedBuilder class.

### Added
- many, many more tests.

## [0.1.0] - 2017-09-22
### Added
- initial development of package.
- unit tests with 100% code coverage.
