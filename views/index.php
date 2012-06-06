<div id="faq">
    <div id="questions">
        <ul>
        <?php 
        foreach ($faqs['entries'] as $question)
        {
          echo '<li>' .anchor(BASE_URL. '/faq/#' . $question['id'], $question['question'], 'class="faq_q"') . '</li>';  
        } 
        ?>
        </ul>
    </div>
    <div id="answers">
        <ul>
        <?php
        foreach ($faqs['entries'] as $answer)
        {
            echo '<li class="answer">';
            echo '<h4><a id="' .$answer['id']. '">' .$answer['question']. '</a></h4>';
            echo '<p>' .$answer['answer']. '</p>';
            echo '</li>';
        }
        ?>
        </ul>
    </div>
</div>