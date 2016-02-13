# GitHub Repository Comparator

[![License](https://poser.pugx.org/tomzx/github-repository-comparator/license.svg)](https://packagist.org/packages/tomzx/github-repository-comparator)
[![Latest Stable Version](https://poser.pugx.org/tomzx/github-repository-comparator/v/stable.svg)](https://packagist.org/packages/tomzx/github-repository-comparator)
[![Latest Unstable Version](https://poser.pugx.org/tomzx/github-repository-comparator/v/unstable.svg)](https://packagist.org/packages/tomzx/github-repository-comparator)
[![Build Status](https://img.shields.io/travis/tomzx/github-repository-comparator.svg)](https://travis-ci.org/tomzx/github-repository-comparator)
[![Code Quality](https://img.shields.io/scrutinizer/g/tomzx/github-repository-comparator.svg)](https://scrutinizer-ci.com/g/tomzx/github-repository-comparator/code-structure)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/tomzx/github-repository-comparator.svg)](https://scrutinizer-ci.com/g/tomzx/github-repository-comparator)
[![Total Downloads](https://img.shields.io/packagist/dt/tomzx/github-repository-comparator.svg)](https://packagist.org/packages/tomzx/github-repository-comparator)

`GitHub Repository Comparator` is a small laravel application which will fetch repositories data from the GitHub API.

The main purpose of `GitHub Repository Comparator` is to allow users to quickly glance over a list of repositories and determine, based on their metrics, which one they'd like to do forward with.

## Metrics

- Number of watchers
- Number of stars
- Number of forks
- Last commit datetime
- Number of open issues
- Number of open pull requests

## Requirements

1. PHP 5.4 <=
2. [MongoDB](http://www.mongodb.org/)
3. [PHP MongoDB driver](http://php.net/manual/en/set.mongodb.php)

## Getting started

1. Clone the repository
2. Edit the `.env` file to specify your github application `CLIENT_ID` and `CLIENT_SECRET`
3. Make your server point to the `public` folder
4. Compare projects!

## License

The code is licensed under the [MIT license](http://choosealicense.com/licenses/mit/). See [LICENSE](LICENSE).
