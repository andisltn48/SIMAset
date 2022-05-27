<?php
return [

    /**
     * You can generate API keys here: https://cloudconvert.com/dashboard/api/v2/keys.
     */

    'api_key' => env('CLOUDCONVERT_API_KEY', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYzU5ODZmNDZhOGYwZjM0ZTgyOWVlN2Y2ZWE1MjMxYzU2OTA1YWQwMmNlMmQxMWEzOWVkYzUxMzE4ZGEwMGM3Y2RlZWZjNjE0MWY5YWIxZTUiLCJpYXQiOjE2NTM1MzY0ODMuNjY3MDkyLCJuYmYiOjE2NTM1MzY0ODMuNjY3MDk0LCJleHAiOjQ4MDkyMTAwODMuNjU1MjQxLCJzdWIiOiI1ODExODYwNiIsInNjb3BlcyI6WyJ1c2VyLnJlYWQiLCJ1c2VyLndyaXRlIiwidGFzay5yZWFkIiwidGFzay53cml0ZSIsIndlYmhvb2sucmVhZCIsIndlYmhvb2sud3JpdGUiLCJwcmVzZXQucmVhZCIsInByZXNldC53cml0ZSJdfQ.Zcqbd8PwrfJTu6z4ma0VB_lwzC8Vgd9EZnnRDS5D4ZGKvxaXMwrNcCyUsD97AO4FIRgzbwcU1_uT-FmvysV4n_oc-ih2SWjWzhk3Ung63Jk4bqNisDHo965o-anc-6590rOIKoSKurgeG5Yk3mc0pujNJdMXfH_RV8vePXrdQvTkF52FCakgr--vvGQEtG0xOv1kgs0wQ8mOUJL4I2O37qoTiiRGsTp3SZ6j88QHW2xA4D6LFiOoDMgisjsboxCNqPBnGZJeny6ETK289htL7oECUzCyFFs9Fsny7hvlncJuuVfus6S69x9SSMfny6s6sTiq103S2OnpkeUsM30eGQGpAzlFliMp5pN0cOffZDA0aTmQV4Ka4_IeyAuJ3FfrBkS6mY_Xn2tlpAwvF4a8CdH3yVNfqhB_W9MtNS-ki1MuNosp96BPBvbtETHk4SBHZGbCGT8mf5QA6OREBKzou2PNjcXgafHObNKoW-4l1ei0tcHDYRVpv_AdepdiB5Jvq_pWlMUMgpf6XrZy4CRRu6r3XDQHZp8EZ8qYdQyzX0cKr1kfZjRDqJ9d1aQN11ToA29M6VRpp2yuZNIO210b78Q9ky4EAmsroWJ0IJd9hm20zpHm3ZddC4s0ZSugL4gV1OojjBiVnqCtL7laY0S_yOzl68-dRHpW8Oacl3WrHLg'),

    /**
     * Use the CloudConvert Sanbox API (Defaults to false, which enables the Production API).
     */
    'sandbox' => env('CLOUDCONVERT_SANDBOX', false),

    /**
     * You can find the secret used at the webhook settings: https://cloudconvert.com/dashboard/api/v2/webhooks
     */
    'webhook_signing_secret' => env('CLOUDCONVERT_WEBHOOK_SIGNING_SECRET', '')

];
