---
layout: docs
title: News Letter
group: components
toc: true
---
## Style 01{.doc-toc-heading}
{{< docs/example>}}
    {{< sample-code.inline >}}
    <div class="py-10">
        {{ partial  "elements/news-letter/style-1" (dict "currentPage" . "buttontitle" "Subscribe" "class" "mx-auto newletter-follow-form" ) }}
    </div>
    {{</ sample-code.inline >}}
{{< /docs/example >}}

## Style 02{.doc-toc-heading}
{{< docs/example>}}
    {{< sample-code.inline >}}
    <div class="py-10">
        {{ partial  "elements/news-letter/style-2" (dict "currentPage" . "desc" "I accept the <a href=\"#\" class=\"text-decoration-none text border-bottom\">terms & conditions</a> and <a href=\"#\" class=\"text-decoration-none border-bottom\">the data protection</a>" "buttontitle" "Subscribe"
        "formInputClass" "rounded-left border-0 input-focus"
        ) }}
    </div>
    {{</ sample-code.inline >}}
{{< /docs/example >}}
