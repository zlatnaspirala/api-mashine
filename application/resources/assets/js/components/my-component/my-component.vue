
<template>
<div>
  FINALLY MY COMPONENT IN CLASS VUE COMPONENT
</div>
</template>

<script lang="ts">

import Component from 'vue-class-component'
import Vue from 'vue';

@Component
export default class myComponent extends Vue {

  public name = "my-component"

  data() {
    return {
      "postMashine": {
      }
    }
  }

  mounted() {
    this.prepareComponent();
  }

  prepareComponent() {
    console.log("My component loaded...")
    this.testRun()
  }

  testRun () {

    var root = this;
    setTimeout(function() {

      console.log("test run")

      fetch('/api/v1/posts/51', {
          method: 'GET',
          headers: {
              'Content-Type': '*',
              'Accept': 'application/json, text/plain, */*',
              'X-CSRF-TOKEN': document.cookie.split("TOKEN=")[1],
              // 'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImMyMzgzN2JkMWZlOTM4YmFlM2E5ODMwZTM2N2Q2ZTM0YWU4NTQyYzQwOGM0ODdiYTNmNjkxNzlhNDc0NTQxMWZlZGM3YmQwZThhZTYwMTg1In0.eyJhdWQiOiIxIiwianRpIjoiYzIzODM3YmQxZmU5MzhiYWUzYTk4MzBlMzY3ZDZlMzRhZTg1NDJjNDA4YzQ4N2JhM2Y2OTE3OWE0NzQ1NDExZmVkYzdiZDBlOGFlNjAxODUiLCJpYXQiOjE2MDAyNzcwODksIm5iZiI6MTYwMDI3NzA4OSwiZXhwIjoxNjMxODEzMDg5LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Uh7cr3dBsIh5_G2vrNfzjFq5efSdMZ3Hc6hjUobZo6VLTUuA_ihCZjADU6BKD-Ht_T67aJ0Afm94IJeHFy7yCHec8mQaJaQm4qW2Mz88xkEIRvNZR7gXbB86mtonzWJGKiMb9yabejGZDiIEBrF7OKJKmpMslzU0SnCNRUcAEs-GJy4UYNG0S7U_OaUy2hhDBVYBCQd2qKpdjjRmH6BKBmjipj9PtM7pa654-GGKDDJ0j-EJI96740vNcy8seLsrcjZmUT6gix_znVyglta4d8tT4S9bj2VTmBMZ6g6DlWf83NjewhzXDwiXBlNAAx39RcYxhK6BK7XXzLgYddKC6HDYsJ1syt-c5hLK4oCsPmKc71FBnQ6x70G8J3L9yn3lzK80q4Y6QBl5pXAZIYtPtdYtak9e3kwGMIg5w8zVz3JdqF9-tbLkWIOags6KTz4ZJb7RP7ShZCyKQZYvMKldNYibOzYgnGVQM9eoA5ULaa8bjepPmqEz5kaAJC248IsezfJUYSaJDh1DoduzM3j7r4mjtviCJ910j-3Om-Oo1DAEsYUnJKKLtCsLIGzlTXK7M392Kg3Va5rargOjOEYWl4eHo1Q7D4GX-gfWxBsGh2Q1vfmjWMKaoT65zuWz_wl4n58dw9cmXyTiD7YZmH_gsTLn_1Oza4CSMhsnhLZHjVk'
          },
          // body: JSON.stringify(root.data.data) // body data type must match "Content-Type" header
        })
      .then((response) =>{
        return response.json()
      } )
      .then((data) => {
        console.log(data)
      })


      var mydata =  {
      "data" : {
          "type": "posts",
          "attributes": {
              "title": "My First Post",
              "slug": "my-first-post",
              "content": " blabla"
          },
          "links": {
              "self": "https://example.org/api/v1/posts/"
          }
        }
      };


      fetch('/api/v1/posts', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/vnd.api+json',
            'Accept': 'application/vnd.api+json',
            'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImMyMzgzN2JkMWZlOTM4YmFlM2E5ODMwZTM2N2Q2ZTM0YWU4NTQyYzQwOGM0ODdiYTNmNjkxNzlhNDc0NTQxMWZlZGM3YmQwZThhZTYwMTg1In0.eyJhdWQiOiIxIiwianRpIjoiYzIzODM3YmQxZmU5MzhiYWUzYTk4MzBlMzY3ZDZlMzRhZTg1NDJjNDA4YzQ4N2JhM2Y2OTE3OWE0NzQ1NDExZmVkYzdiZDBlOGFlNjAxODUiLCJpYXQiOjE2MDAyNzcwODksIm5iZiI6MTYwMDI3NzA4OSwiZXhwIjoxNjMxODEzMDg5LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Uh7cr3dBsIh5_G2vrNfzjFq5efSdMZ3Hc6hjUobZo6VLTUuA_ihCZjADU6BKD-Ht_T67aJ0Afm94IJeHFy7yCHec8mQaJaQm4qW2Mz88xkEIRvNZR7gXbB86mtonzWJGKiMb9yabejGZDiIEBrF7OKJKmpMslzU0SnCNRUcAEs-GJy4UYNG0S7U_OaUy2hhDBVYBCQd2qKpdjjRmH6BKBmjipj9PtM7pa654-GGKDDJ0j-EJI96740vNcy8seLsrcjZmUT6gix_znVyglta4d8tT4S9bj2VTmBMZ6g6DlWf83NjewhzXDwiXBlNAAx39RcYxhK6BK7XXzLgYddKC6HDYsJ1syt-c5hLK4oCsPmKc71FBnQ6x70G8J3L9yn3lzK80q4Y6QBl5pXAZIYtPtdYtak9e3kwGMIg5w8zVz3JdqF9-tbLkWIOags6KTz4ZJb7RP7ShZCyKQZYvMKldNYibOzYgnGVQM9eoA5ULaa8bjepPmqEz5kaAJC248IsezfJUYSaJDh1DoduzM3j7r4mjtviCJ910j-3Om-Oo1DAEsYUnJKKLtCsLIGzlTXK7M392Kg3Va5rargOjOEYWl4eHo1Q7D4GX-gfWxBsGh2Q1vfmjWMKaoT65zuWz_wl4n58dw9cmXyTiD7YZmH_gsTLn_1Oza4CSMhsnhLZHjVk'
        },
        body: JSON.stringify(mydata)
      })
      .then((response) =>{
        return response.json()
      } )
      .then((data) => {
        console.log(data)
      })

      }, 4000)

    }

  }

</script>
