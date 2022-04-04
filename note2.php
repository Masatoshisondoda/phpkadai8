<?php
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div id="two-way-binding">
        <p>{{ message }}</p>
        <input v-model="message" />
    </div>
    <script src="https://unpkg.com/vue@next"></script>
    <script>
        const TwoWayBinding = {
            data() {
                return {
                    message: 'Hello Vue!'
                }
            }
        }

        Vue.createApp(TwoWayBinding).mount('#two-way-binding')
    </script>
</body>

</html>