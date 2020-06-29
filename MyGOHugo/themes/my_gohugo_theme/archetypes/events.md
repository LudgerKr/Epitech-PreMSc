---
title: "{{ replace .Name "-" " " | title }}"
date: {{ .Date }}
address: ""
postalCode: "75000"
city: "Paris"
label: ""
when: "{{ now.Format "January 2, 2000 12:00" }}"
description: ""
photo: ""
draft: false
important: "false"
association: ""
latitude: ""
longitude: ""
---