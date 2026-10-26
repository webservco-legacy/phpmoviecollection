# phpMovieCollection

phpMovieCollection, a PHP and MySQL web app of 2007 and 2008 to manage a movie collection and show it as a site: a setup
utility that checks the requirements, English and Romanian, skins, titles and pictures fetched from IMDb, a user manual
and developer documentation. Version 1.1.1 was my final project for a PHP and MySQL course in 2008. A
historical archive, kept read-only: the PHP 4 and 5 code of its time is not safe to deploy today, and
today's IMDb pages break the fetch.

## History

| Date | Commit | |
|---|---|---|
| 2007-05-11 | 9f7ea2f | the first version, branch `pmc-2007-05` |
| 2007-09-22 | c425ca8 | the second version, with my notes and the scripts I studied in `_stuff/`, branch `pmc-2007-09` |
| 2008-08-19 | 1ddefe3 | the rewrite, first as phpMyMovieCollection, branch `main` |
| 2008-10-14 | eefb6a2 | phpMovieCollection 1.0.0 (tag `v1.0.0` in my old repository) |
| 2008-10-23 | 8fa39b0 | the IMDb picture fetch, worked on apart, branch `imdb-pic` |
| 2008-10-30 | 8e10630 | 1.1.0 (`v1.1.0`) |
| 2008-11-02 | 0644fa3 | 1.1.1 (`v1.1.1`) |
| 2008-11-04 | 77ffc1d | 1.1.1, the package of 2008-11-04 (`v1.1.1-081104`), then the manuals and the project site |
| 2008-11-19 | 97b56ef | the demo installation, the last change |

## What is in it

- the app at the top of `main`: `index.php`, `admin/`, `inc/`, `lib/`, `lang/`, `skin/`, `setup/`, and the README,
  INSTALL, UPGRADE, FAQ and ChangeLog files;
- `extra/doc/`: the manuals (HTML, CHM and their sources); `extra/skins/`, `extra/graphics/`: the skin and its layouts;
- `extra/site/`: the pages of the project site (pmc.rudisoft.net, 2008), without the wiki engine it ran on;
- `extra/demo/`, `extra/notes/`: the demo installation and my development notes.

Left out of the whole history: other people's apps and
scripts that I saved while studying (movie and music databases, menus, a calendar, tooltips, search scripts), the
fonts whose licence does not allow it (Verdana and six freeware fonts), the BoltWire wiki engine of the project site (its licence does not allow redistribution), the
site's admin login and search index. The demo installation's database stays private.

## How it was built

From my backups: 71 dated snapshots of 2008, the release packages, the manuals, the demo and the saved project site,
turned into git in 2026 (95 commits on all branches), the dates kept; the two versions of 2007 and the IMDb
picture work on their own branches. The last commit of each branch before this README sets LF line endings and indents
with spaces.

## Third-party code

Kept, each under its own licence: Browser Emulating file functions 2.0.1 by Kai Blankenhorn (GPL v2 or later, in
`lib/`, `inc/` and `test/`); the Bitstream Vera Sans Mono font (Bitstream Vera licence, `lib/ttf/`); the Bijou JL
font by Jeff Levine (freeware, not for sale; `inc/fonts/`, in the history only); the Full Text
Search Parser by Digital Stratum, Inc. (BSD, `_stuff/fts_parser/` on `pmc-2007-09`).

## Licence

GNU GPL v2 (`LICENSE`), as the project shipped it.

See also the other archives of my early projects in [webservco-legacy](https://github.com/webservco-legacy).
