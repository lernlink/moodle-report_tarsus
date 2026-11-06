# Tarsus analytics report for Moodle (report_tarsus)

A course report for the Tarsus AI learning coach.

**Early stage (alpha).** The report currently registers itself in the course
navigation and shows a placeholder. The first release will surface native
Moodle data of the Tarsus activities (attempts, answers, the usage ledger)
with CSV and Excel export; Tarsus Advisory insights and dropout risk follow
later.

Requires **local_tarsus**. See its README for the whole plugin set.

## Requirements

- Moodle 5.0 or later, tested on 5.2 and 5.3; PHP 8.2 or later.
- local_tarsus installed.

## Installation

1. Install local_tarsus.
2. Unzip into `report/tarsus` (Moodle 5.1+: `public/report/tarsus`), or add
   the repository as a Git submodule at that path.
3. Visit *Site administration › Notifications* to install.
4. Open the report from the course's *Reports* page.

## Capabilities

| Capability | Default roles |
|---|---|
| `report/tarsus:view` | Teacher, editing teacher, manager |

## Privacy

The report stores no personal data of its own.

## Credits

Developed by Vadym Nersesov, lern.link GmbH. Tarsus and the Flexudy Brain are
products of Tarsus GmbH.

## License

GNU GPL v3 or later: https://www.gnu.org/licenses/
