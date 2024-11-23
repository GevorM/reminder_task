<?php

return [
    'pre_expiration_intervals' => explode(',', env('PRE_EXPIRATION_INTERVALS', '7,3,1')),
    'post_expiration_intervals' => explode(',', env('POST_EXPIRATION_INTERVALS', '1,2')),
];
