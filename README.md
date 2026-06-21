# Demo Module

Small inactive demo module used by local extension discovery and Admin Extension Management views.

When activated, it contributes configurable public demo routes, a dynamic after-content injection, scoped assets, translated demo copy, and extension-owned settings through `extension.php`.

The public `/demo` route is intentionally a lightweight info page for Studio's extension contracts. It demonstrates route configuration, extension-owned settings, scoped assets, translations, and dynamic content injection. `/demo/typography` carries the Markdown typography fixture without registering production behavior.

Run the module's host-integration tests from the Studio root:

```bash
bin/phpunit extensions/demo-module/tests
```
