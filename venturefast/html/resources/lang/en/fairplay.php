<?php

return [
    'text' => '<h3>Fair game! How does it work?</h3>
        <p>For every deposited <span style="color: white">1 cent</span> you get <span style="color: white">1 ticket.</span>. For convenience, we derive the price in rubles.</p>
        <p class="quote">For example: if you deposited $100, you get 10000 tickets.</p>
        <p>At the beginning of each round our system picks random number from 0 to 1 (for example 0.073185018861535), hashes it with MD5 and shows it ciphered at the beginning of the round. (<a href="https://ru.wikipedia.org/wiki/MD5" target="_blank">What is MD5?</a>)</p>
        <p>When the round is over, system shows the number which was ciphered in the beginning (you can check it here) and multiplies it by bank amount (in cents).</p>
        <p class="quote">For example, at the end of the round the bank has 5000 dollars (500000 cents). The number 0,07318501886153 is multiplied by 500000 cents (the numbers are taken as an example) and we get 36592,509430765. It is approximated to number 36593 and the person who has the ticket 36593 wins. That means that the more you deposit, the more tickets you get, and the chance to win is bigger.</p>
        <p>That’s all. The fair game principle means that we don’t know how big the bank at the end of the game will be, but the random number is given at the beginning of the game and even if we wanted we wouldn’t be able to pick a false winner.</p>
        <div class="game-checker">
            <h3>Round check</h3>
            <p>Game number * Last ticket number = Advantageous ticket</p>',
	'hash' => 'Round hash',
	'round_number' => 'Game number',
	'round_price' => 'Last ticket number',
	'sumbit' => 'CHECK',
];