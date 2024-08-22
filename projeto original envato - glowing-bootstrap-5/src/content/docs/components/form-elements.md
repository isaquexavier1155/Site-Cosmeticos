---
layout: docs
title: Forms
description: Examples and usage guidelines for form control styles, layout options, and custom components for creating a wide variety of forms.
group: components
toc: true
---

## Form Control{.doc-toc-heading}

## Example{.doc-toc-heading}

Form controls are styled with a mix of Sass and CSS variables, allowing them to adapt to color modes and support any customization method.

{{< docs/example >}}
<div class="mb-5">
  <label for="exampleFormControlInput1" class="form-label">Email address</label>
  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
</div>
<div class="mb-5">
  <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>
{{< /docs/example >}}

## Sizing{.doc-toc-heading}

Set heights using classes like `.form-control-lg` and `.form-control-sm`.

{{< docs/example >}}
<input class="form-control form-control-lg" type="text" placeholder=".form-control-lg" aria-label=".form-control-lg example">
<input class="form-control mt-5" type="text" placeholder="Default input" aria-label="default input example">
<input class="form-control form-control-sm mt-5" type="text" placeholder=".form-control-sm" aria-label=".form-control-sm example">
{{< /docs/example >}}

## Form text{.doc-toc-heading}

Block-level or inline-level form text can be created using `.form-text`.

{{< docs/callout warning >}}
Form text should be explicitly associated with the form control it relates to using the `aria-labelledby` (for mandatory information such as data format) or `aria-describedby` (for complementary information) attribute. This will ensure that assistive technologies—such as screen readers—will announce this form text when the user focuses or enters the control.
{{< /docs/callout >}}

Form text below inputs can be styled with `.form-text`. If a block-level element will be used, a top margin is added for easy spacing from the inputs above.

{{< docs/example >}}
<label for="inputPassword5" class="form-label">Password</label>
<input type="password" id="inputPassword5" class="form-control" aria-labelledby="passwordHelpBlock">
<div id="passwordHelpBlock" class="form-text">
  Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
</div>
{{< /docs/example >}}

Inline text can use any typical inline HTML element (be it a `<span>`, `<small>`, or something else) with nothing more than the `.form-text` class.

{{< docs/example >}}
<div class="row g-5 align-items-center">
  <div class="col-auto">
    <label for="inputPassword6" class="col-form-label">Password</label>
  </div>
  <div class="col-auto">
    <input type="password" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
  </div>
  <div class="col-auto">
    <span id="passwordHelpInline" class="form-text">
      Must be 8-20 characters long.
    </span>
  </div>
</div>
{{< /docs/example >}}

## Disabled{.doc-toc-heading}

Add the `disabled` boolean attribute on an input to give it a grayed out appearance, remove pointer events, and prevent focusing.

{{< docs/example >}}
<input class="form-control" type="text" placeholder="Disabled input" aria-label="Disabled input example" disabled>
<input class="form-control mt-5" type="text" value="Disabled readonly input" aria-label="Disabled input example" disabled readonly>
{{< /docs/example >}}

## Readonly{.doc-toc-heading}

Add the `readonly` boolean attribute on an input to prevent modification of the input's value. `readonly` inputs can still be focused and selected, while `disabled` inputs cannot.

{{< docs/example >}}
<input class="form-control" type="text" value="Readonly input here..." aria-label="readonly input example" readonly>
{{< /docs/example >}}

## Readonly plain text{.doc-toc-heading}

If you want to have `<input readonly>` elements in your form styled as plain text, replace `.form-control` with `.form-control-plaintext` to remove the default form field styling and preserve the correct `margin` and `padding`.

{{< docs/example >}}
  <div class="mb-6 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
    </div>
  </div>
  <div class="mb-6 row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword">
    </div>
  </div>
{{< /docs/example >}}

{{< docs/example >}}
<form class="row g-3">
  <div class="col-auto">
    <label for="staticEmail2" class="visually-hidden">Email</label>
    <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="email@example.com">
  </div>
  <div class="col-auto">
    <label for="inputPassword2" class="visually-hidden">Password</label>
    <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-6">Confirm identity</button>
  </div>
</form>
{{< /docs/example >}}

## File input{.doc-toc-heading}

{{< docs/example >}}
<div class="mb-6">
  <label for="formFile" class="form-label">Default file input example</label>
  <input class="form-control" type="file" id="formFile">
</div>
<div class="mb-6">
  <label for="formFileMultiple" class="form-label">Multiple files input example</label>
  <input class="form-control" type="file" id="formFileMultiple" multiple>
</div>
<div class="mb-6">
  <label for="formFileDisabled" class="form-label">Disabled file input example</label>
  <input class="form-control" type="file" id="formFileDisabled" disabled>
</div>
<div class="mb-6">
  <label for="formFileSm" class="form-label">Small file input example</label>
  <input class="form-control form-control-sm" id="formFileSm" type="file">
</div>
<div>
  <label for="formFileLg" class="form-label">Large file input example</label>
  <input class="form-control form-control-lg" id="formFileLg" type="file">
</div>
{{< /docs/example >}}

## Color{.doc-toc-heading}

Set the `type="color"` and add `.form-control-color` to the `<input>`. We use the modifier class to set fixed `height`s and override some inconsistencies between browsers.

{{< docs/example >}}
<label for="exampleColorInput" class="form-label">Color picker</label>
<input type="color" class="form-control form-control-color" id="exampleColorInput" value="#563d7c" title="Choose your color">
{{< /docs/example >}}

## Datalists{.doc-toc-heading}

Datalists allow you to create a group of `<option>`s that can be accessed (and autocompleted) from within an `<input>`. These are similar to `<select>` elements, but come with more menu styling limitations and differences. While most browsers and operating systems include some support for `<datalist>` elements, their styling is inconsistent at best.

Learn more about [support for datalist elements](https://caniuse.com/datalist).

{{< docs/example >}}
    <label for="exampleDataList" class="form-label">Datalist example</label>
    <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
    <datalist id="datalistOptions">
      <option value="San Francisco">
      <option value="New York">
      <option value="Seattle">
      <option value="Los Angeles">
      <option value="Chicago">
    </datalist>
{{< /docs/example >}}

## CSS{.doc-toc-heading}

### Sass variables{.doc-toc-heading}

`$input-*` are shared across most of our form controls (and not buttons).

{{< docs/scss-docs name="form-input-variables" file="src/assets/scss/_theme-variables.scss" >}}

`$form-label-*` and `$form-text-*` are for our `<label>`s and `.form-text` component.

{{< docs/scss-docs name="form-label-variables" file="src/assets/scss/_theme-variables.scss" >}}

{{< docs/scss-docs name="form-text-variables" file="src/assets/scss/_theme-variables.scss" >}}

`$form-file-*` are for file input.

{{< docs/scss-docs name="form-file-variables" file="src/assets/scss/_theme-variables.scss" >}}