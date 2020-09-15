
<template>
  <div>


  </div>
</template>


<script>
    export default {
        /*
         * The component's data.
         */
        data() {
            return {
              tokens: ['eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImU1NWFhYzEzODU5YjVlODlmNDQ2ZDI2YTJmZDk3YjlkY2Y5ZDQzYjNlNjE2NTQxNWIwYzUyOWUxYjc2NTFiMTFhZmE4Y2E2OWRiODBkYmM5In0'],
              "data": {
    "data": [
        {
            "type": "posts",
            "id": "1",
            "attributes": {
                "title": "My First Post",
                "slug": "my-first-post"
            },
            "links": {
                "self": "/api/posts/1"
            }
        },
        {
            "type": "posts",
            "id": "2",
            "attributes": {
                "title": "Hello World",
                "slug": "hello-world"
            },
            "links": {
                "self": "/api/posts/1"
            }
        }
    ]
}
          }
        },

        /**
         * Prepare the component (Vue 1.x).
         */
        ready() {
            this.prepareComponent();
        },

        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
            this.prepareComponent();
        },

        methods: {
            /**
             * Prepare the component (Vue 2.x).
             */
            prepareComponent() {
                // this.getTokens();
                console.log("GOOOOOOOOOOOOOO")
                this.testRun()
            },

            /**
             * Get all of the authorized tokens for the user.
             */
            getTokens() {
                axios.get('/oauth/tokens')
                        .then(response => {
                            this.tokens = response.data;
                        });
            },

            /**
             * Revoke the given token.
             */
            revoke(token) {
                axios.delete('/oauth/tokens/' + token.id)
                        .then(response => {
                            this.getTokens();
                        });
            },


            testRun () {

              console.log("test run")

              var root = this;

              fetch('/api/v1/posts/', {
                      method: 'POST', // *GET, POST, PUT, DELETE, etc.
                      //mode: 'cors', // no-cors, *cors, same-origin
                      //cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                      //credentials: 'same-origin', // include, *same-origin, omit
                      headers: {
                        'Content-Type': 'application/json',
                         'Accept': 'application/vnd.api+json',
                        'X-CSRF-TOKEN': document.cookie.split("TOKEN=")[1],
                        // 'Content-Type': 'application/x-www-form-urlencoded',
                        'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImU1NWFhYzEzODU5YjVlODlmNDQ2ZDI2YTJmZDk3YjlkY2Y5ZDQzYjNlNjE2NTQxNWIwYzUyOWUxYjc2NTFiMTFhZmE4Y2E2OWRiODBkYmM5In0.eyJhdWQiOiIxIiwianRpIjoiZTU1YWFjMTM4NTliNWU4OWY0NDZkMjZhMmZkOTdiOWRjZjlkNDNiM2U2MTY1NDE1YjBjNTI5ZTFiNzY1MWIxMWFmYThjYTY5ZGI4MGRiYzkiLCJpYXQiOjE2MDAxODcwNDksIm5iZiI6MTYwMDE4NzA0OSwiZXhwIjoxNjMxNzIzMDQ4LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.KIvnWqtB1ULbRe9VGP0CtFyvdqK6COPm50xtjN54WsM9aH6J679w93-ZLbhcoSXQdabtOEdbbUpcAYYCtYjoVLc6YK-WWqg9oz3Zv4Kh9yb2RO5o3iKJZo0FmwFuXBPnXhfR7tPrYdUOY39x3jkPScSO3lZ46piQB9wl3hWNFMccIAlBraxECiqIOZ_hMCL8Kuy_gh5Dzl-HXTtwmHZC9cYxCeiAsSvdDINmXiW9Jm87RHQqm15c1ZdOiNDW3YPgxCsXznWeejY0nijwivpOaw3KWuMWD4vKzXcw8j3EXYhnSREYHUDto5ZJlP_VAs71gpSFRBxt9FQ9QzAx_6-p_5bimxN79pHXic9KYiKPuRwI0sPw4joUtISwfVmbCkFyxmfNm6qj-pfC6YJdpPDrh4oKC1eTA-_iqkTgBQN21A1yQ7mcack52HvaSJV2TIgzM84pNbRFTDloxnRldVhQ9Vep9FDxGw9Wiuc4qChR5FbyFm0rtej2YGruostC2idU80HhVXjNCiSKMuPdfyx52zIbV4wKDAkcHxJCPEpQCspy0OrQVK1Rh53EW-BwViI_GCfIxWUIHzKjqDbUjNwRidc_UzkfP-qz3KltVjLukS5vO510L3UxGXEfsyH3jaE45r-SZNMBTWqN5ZvVSouFzFstuQJhtPUS0zydMXBfCOw'
                      },
                      //redirect: 'follow', // manual, *follow, error
                      //referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
                      body: JSON.stringify(root.data.data) // body data type must match "Content-Type" header
                    })
                  .then((response) =>{
                    return response.json()
                  } )
                  .then((data) => {

                    console.log(data)

                  })
            }


        }
    }
</script>

