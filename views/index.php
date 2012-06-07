{{ title }}
{{ if faqs.total > 0 }}
<div id="faq">
    {{ pagination:links }}
    <div id="questions">
        <ol>
            {{ faqs.entries }}
            <li><a class="faq_q" href="<?php echo BASE_URL ?>faq/#{{ id }}">{{ question }}</a></li>
            {{ /faqs.entries }}
        </ol>
    </div>
    <div id="answers">
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
<h4>There are currently no FAQs.</h4>
{{ endif }}