@component('mail::message')
# Introduction

Votre commande a éte bien envoye..

@component('mail::button', ['url' => ''])
Cliquer
@endcomponent

@component('mail::table')
| Laravel       | Table         | Example  |
| ------------- |:-------------:| --------:|
| Col 2 is      | Centered      | $10      |
| Col 3 is      | Right-Aligned | $20      |
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
