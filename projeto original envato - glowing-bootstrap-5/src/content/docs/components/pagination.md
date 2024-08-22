---
layout: docs
title: Pagination
description: Use our pagination and breadcrumb examples to show that a series of related content exists across multiple pages and navigational hierarchy.
toc: true
---
## Default{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
	{{ partial  "elements/paging/pagination" (dict "class" "py-10 justify-content-center" )}}
{{</ sample-code.inline >}}
{{< /docs/example >}}

## Load More{.doc-toc-heading}

{{< docs/example>}}
{{< sample-code.inline >}}
{{ partial  "elements/paging/load-more" (dict "class" "py-10 text-center" )}}
{{</ sample-code.inline >}}
{{< /docs/example >}}

## Breadcrumb{.doc-toc-heading}

{{< docs/example>}}
{{< blocks/page-title/breadcrumb  title="Library"/>}}
{{< /docs/example >}}