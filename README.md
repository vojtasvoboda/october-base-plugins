# October base plugins

Collection of base plugins for OctoberCMS.

## Contacts

- Contact with form - contact form with mailer.

## Events

- Without any category - events, date from, date to.
- With registration form - saving registrations to the events.

## Galleries

- Just basic galleries management

## Partners

- In one category - partner logos, each partner in one category.

## References

References management with cover photo, gallery, top flag. Translations compatible. Seeding.

Reference detail page example:

```
title = "Reference"
url = "/reference/:slug"
layout = "default"
==
<?php
function onStart() {
    $this['reference'] = Site\References\Models\Reference::isEnabled()->transWhere('slug', $this->param('slug'))->first();
    if ($this['reference'] !== null) {
        $this->page->title = $this['reference']->name;
        $this->page->meta_description = $this['reference']->name;
        if ($this['reference']->cover->count()) {
            $viewBag = $this->page->getViewBag();
            $viewBag->setProperty('og_image', $this['reference']->cover->getPath());
        }

    } else {
        $this->page->title = "Reference not found";
        header("HTTP/1.0 404 Not Found");
        flush();
    }
}
?>
==
{% if reference %}
	{{ reference.name }}
	{{ reference.text | raw }}
	{% if reference.images.count() %}
		{% for image in reference.images %}
			image
       {% endfor %}
	{% endif %}
{% else %}
	Not found
{% endif %}
```

Layout:

```
$this['viewBag'] = $this->page->getViewBag()->getProperties() ? $this->page->getViewBag()->getProperties() : null;
==
<meta property="og:image" content="{{ viewBag.og_image ? viewBag.og_image : ('assets/images/share.jpg' | theme) }}" />
```

## Team members

- Manage team members with names, positions, mails and photos.