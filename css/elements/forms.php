<?php if(false): ?><style><?php endif; ?>

input,textarea,select {
	padding:1em;
	border: 1px solid rgba(203, 203, 203, 1); 
	font-size: 1rem;
}
input[type=checkbox], input[type=radio] {
	font-size: 1.5em;
    width: 15px;
}
select {
    -webkit-appearance: none;
    border-radius: 0;
    background-image: linear-gradient(45deg, transparent 50%, gray 50%), linear-gradient(135deg, gray 50%, transparent 50%), linear-gradient(to right, #ccc, #ccc);
    background-position: calc(100% - 20px) 50%, calc(100% - 15px) 50%, calc(100% - 43px) 30%;
    background-size: 5px 5px, 5px 5px, 1px 2em;
    background-repeat: no-repeat;
    padding-right: 3em;
    text-indent: 1em;
}

select:focus {
    background-image: linear-gradient(45deg,<?=$hiilite_options['color_one'];?> 50%,transparent 50%),linear-gradient(135deg,transparent 50%,<?=$hiilite_options['color_one'];?> 50%),linear-gradient(to right,#ccc,#ccc);
    background-position: calc(100% - 15px) 50%,calc(100% - 20px) 50%,calc(100% - 43px) 30%;
    background-size: 5px 5px,4px 5px,1px 2em;
    background-repeat: no-repeat;
    border-color: <?=$hiilite_options['color_one'];?>;
    outline: 0;
}



input:focus, select:focus, textarea:focus {
    box-shadow: 0 1px 4px rgb(77, 144, 254), inset 0 1px 4px rgb(77, 144, 254);
    outline: none;
}