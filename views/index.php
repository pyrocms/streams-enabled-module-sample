<div class="content">

<h2>{{ template:title }}</h2>

{{ if faqs.total > 0 }}
<div id="faq">
    <h3>{{ helper:lang line="faq:questions" }}</h3>
    {{ pagination:links }}
    <div id="questions">
        <ol>
            {{ faqs.entries }}
            <li>{{ url:anchor segments="faq/#{{ id }}" title="{{ question }}" class="question" }}</li>
            {{ /faqs.entries }}
        </ol>
    </div>
    <div id="answers">
        <h3>{{ helper:lang line="faq:answers" }}</h3>
        <ol> 
            {{ faqs.entries }}
            <li class="answer">
                <h4 id="{{ id }}">{{ question }}</h4>
                <p>{{ answer }}</p>
            </li>
            {{ /faqs.entries }}
        </ol>
    </div>
</div>
{{ else }}
<h4>{{ helper:lang line="faq:no_faqs" }}</h4>
{{ endif }}

</div>