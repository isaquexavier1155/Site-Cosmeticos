---
layout: docs
title: Post
group: components
toc: true
---
## Component #1{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
 {{- range $index, $item := $.Site.Data.doc_posts -}}
            {{- if eq $index 0 -}}
                <div style="max-width: 370px">
                    {{ partial  "elements/blog/items/grid-1" (dict
                    "data" $item
                    ) }}
                </div>
            {{- end -}}
        {{- end -}}
{{</ sample-code.inline >}}
{{< /docs/example >}}

## Component #2{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
{{- range $index, $item := $.Site.Data.doc_posts -}}
            {{- if eq $index 1 -}}
                <div style="max-width: 370px">
                    {{ partial  "elements/blog/items/grid-2" (dict
                    "data" $item
                    ) }}
                </div>
            {{- end -}}
        {{- end -}}
{{</ sample-code.inline >}}
{{< /docs/example >}}

## Component #3{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
 {{- range $index, $item := $.Site.Data.doc_posts -}}
            {{- if eq $index 2 -}}
                <div style="max-width: 450px">
                    {{ partial  "elements/blog/items/grid-3" (dict
                    "data" $item
                    ) }}
                </div>
            {{- end -}}
        {{- end -}}
{{</ sample-code.inline >}}
{{< /docs/example >}}

## Component #4{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
        {{- range $index, $item := $.Site.Data.doc_posts -}}
            {{- if eq $index 3 -}}
                {{ partial  "elements/blog/items/list" (dict
                    "data" $item
                    ) }}
            {{- end -}}
        {{- end -}}
{{</ sample-code.inline >}}
{{< /docs/example >}}

## Component #5{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
  {{- range $index, $item := $.Site.Data.doc_posts -}}
            {{- if eq $index 4 -}}
                {{ partial  "elements/blog/items/classic" (dict
                    "data" $item
                    ) }}
            {{- end -}}
        {{- end -}}
{{</ sample-code.inline >}}
{{< /docs/example >}}

## Component #6{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
  {{- range $index, $item := $.Site.Data.doc_posts -}}
            {{- if eq $index 5 -}}
                {{ partial  "elements/blog/items/classic" (dict
                    "data" $item
                    ) }}
            {{- end -}}
            {{- end -}}
{{</ sample-code.inline >}}
{{< /docs/example >}}

## Component #7{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
    {{- range $index, $item := $.Site.Data.doc_posts -}}
        {{- if eq $index 6 -}}
        {{ partial  "elements/blog/items/classic" (dict "data" $item) }}
            {{- end -}}
    {{- end -}}
{{</ sample-code.inline >}}
{{< /docs/example >}}
## Component #8{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
    {{- range $index, $item := $.Site.Data.doc_posts -}}
        {{- if eq $index 7 -}}
            {{ partial  "elements/blog/items/classic" (dict "data" $item ) }}
        {{- end -}}
    {{- end -}}
{{</ sample-code.inline >}}
{{< /docs/example >}}

## Component #9{.doc-toc-heading}
{{< docs/example>}}
{{< sample-code.inline >}}
 {{- range $index, $item := $.Site.Data.doc_posts -}}
            {{- if eq $index 8 -}}
                {{ partial  "elements/blog/items/classic" (dict
                    "data" $item
                    ) }}
            {{- end -}}
    {{- end -}}
{{</ sample-code.inline >}}
{{< /docs/example >}}
