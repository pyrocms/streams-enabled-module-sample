{{ if faqs.total > 0 }}
<div id="faq">
    {{ pagination:links }}
    <div id="questions">
        <ul>
            {{ faqs.entries }}
            <li><a class="faq_q" href="<?php echo BASE_URL ?>faq/#{{ id }}">{{ question }}</a></li>
            {{ /faqs.entries }}
        </ul>
    </div>
    <div id="answers">
        <ul> 
            {{ faqs.entries }}
            <li class="answer">
                <h4><a class="anchor" id="{{ id }}">{{ question }}</a></h4>
                <p>{{ answer }}</p>
            </li>
            {{ /faqs.entries }}
        </ul>
    </div>
</div>
{{ else }}
<h4>There are currently no FAQs.</h4>
{{ endif }}