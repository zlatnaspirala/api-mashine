
<template>
<div>
  <md-button class="md-prioryty md-raised" @click="postMyGameplay">
    testRun
  </md-button>
</div>
</template>

<script lang="ts">

import Component from 'vue-class-component'
import Vue from 'vue';
import VueMaterial from 'vue-material'
  import { mdButton,
           mdInput,
           mdField,
           mdContent
  } from 'vue-material'

Vue.use(VueMaterial)

import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'

// Register for components
@Component({
  components: {
    mdButton,
    mdInput,
    mdField,
    mdContent
  }
})

@Component
export default class myComponent extends Vue {

  public name = "my-component"

  constructor() {
    super()

  }

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
    // this.testRun()
  }

  testRun () {
    var root = this;
    console.log("test run")
    fetch('/api/v1/posts/1', {
        method: 'GET',
        headers: {
            'Content-Type': '*',
            'Accept': 'application/json, text/plain, */*',
            'X-CSRF-TOKEN': document.cookie.split("TOKEN=")[1]
        }
      })
    .then((response) =>{
      return response.json()
    } )
    .then((data) => {
      console.log(data)
    })

  }

  postMyPost () {

    var mydata =  {
      "data" : {
          "type": "posts",
          "attributes": {
              "title": "My First Post",
              "slug": "nikola-test",
              "content": " blabla dfgdfg"
          },
          "links": {
              "self": "https://localhost/api/v1/posts/"
          }
        }
     };


    fetch('/api/v1/posts', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/vnd.api+json',
          'Accept': '*/*',
            'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6Ijc5MzEzNzlkMWI3OTgxYjQyZjg4ZjQ0MjEwMjg4OGM5MzQzNjAyYjUwZWQ5MDYzODdkZTFiNjljNDFjYWJkMGM5NGQwN2YxY2E2NzYzYjdmIn0.eyJhdWQiOiIxIiwianRpIjoiNzkzMTM3OWQxYjc5ODFiNDJmODhmNDQyMTAyODg4YzkzNDM2MDJiNTBlZDkwNjM4N2RlMWI2OWM0MWNhYmQwYzk0ZDA3ZjFjYTY3NjNiN2YiLCJpYXQiOjE2MDA4OTc0MzcsIm5iZiI6MTYwMDg5NzQzNywiZXhwIjoxNjMyNDMzNDM2LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.G8Rlb-my7CmVUXfbPRN1UgW1vOf6fH8y51RQhYjeguYPbrBSou3gU0HMV4gaxSQW0wkzc27U2f6AeIgARBKgkSFcYtERtQrUgDNxcu_eRHyVJNUzxH4408OU35DTLyZ1RqwDyBkibtag9snUfumbOzSzxm8NVCTW0hJk21w5hMRwjarlVbNg3GUWi279z05chf6ZiIXp5grRY1TjGIU7jn01YvbQZ8CnHLzUit3xMCLb5og0mzsAg5h9hRJK-UG-WTveX1hlPY0AStMpcUbEVvCTZIsFpa1eBHgfB8CzEUTeeGWiABFKXgl9BLly9tHj4Jz2BIuTPgnY0_QvUIy1o0SRRwriH0fGO2SbYdYRxJjghzyBuA9h2Wd_Y3ZdBk-ONLyjz0Lei6R-H7-VjcewevWome-iLMHDC-G5qo3D34KdsSu5M-qlXLQl2KI303wb22CY_oAHovTqoNY6KX6wA2K4yx2n9qKctrMlak9STsJn5qi4mZvppj5wVQyQs9X2AHrWc7uykAIw_mAqVJh1CEkhWhI0MNTTkzh0I0KYxRAyrc7vZZ85YpjxJRPH1PF3zj_zxj1yn4WkxSuEpdmsns737zlZ7WUHM1kJTJIAVMN3w3O2kDjetcuqLBZnPs8DUbO-uqhU83hgmv2xfwVG73VmyN1YuJY8dIB9AQnxP9M',
            'X-CSRF-TOKEN': document.cookie.split("TOKEN=")[1]
      },
      body: JSON.stringify(mydata)
    })
    .then((response) =>{
      return response.json()
    } )
    .then((data) => {
      console.log(data)
    })


  }


  postMyGameplay () {

    var mydata =  {
    "data" : {
        "type": "gameplays",
        "attributes": {
            "title": "My First gameplays",
            "channelid": "nikola-tegameplaysst",
            "content": " gameplaysgameplaysgameplaysgameplays dfgdfg"
        },
        "links": {
            "self": "https://localhost/api/v1/gameplays/"
        }
      }
    };


    fetch('/api/v1/gameplays', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/vnd.api+json',
          'Accept': '*/*',
            'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6Ijc5MzEzNzlkMWI3OTgxYjQyZjg4ZjQ0MjEwMjg4OGM5MzQzNjAyYjUwZWQ5MDYzODdkZTFiNjljNDFjYWJkMGM5NGQwN2YxY2E2NzYzYjdmIn0.eyJhdWQiOiIxIiwianRpIjoiNzkzMTM3OWQxYjc5ODFiNDJmODhmNDQyMTAyODg4YzkzNDM2MDJiNTBlZDkwNjM4N2RlMWI2OWM0MWNhYmQwYzk0ZDA3ZjFjYTY3NjNiN2YiLCJpYXQiOjE2MDA4OTc0MzcsIm5iZiI6MTYwMDg5NzQzNywiZXhwIjoxNjMyNDMzNDM2LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.G8Rlb-my7CmVUXfbPRN1UgW1vOf6fH8y51RQhYjeguYPbrBSou3gU0HMV4gaxSQW0wkzc27U2f6AeIgARBKgkSFcYtERtQrUgDNxcu_eRHyVJNUzxH4408OU35DTLyZ1RqwDyBkibtag9snUfumbOzSzxm8NVCTW0hJk21w5hMRwjarlVbNg3GUWi279z05chf6ZiIXp5grRY1TjGIU7jn01YvbQZ8CnHLzUit3xMCLb5og0mzsAg5h9hRJK-UG-WTveX1hlPY0AStMpcUbEVvCTZIsFpa1eBHgfB8CzEUTeeGWiABFKXgl9BLly9tHj4Jz2BIuTPgnY0_QvUIy1o0SRRwriH0fGO2SbYdYRxJjghzyBuA9h2Wd_Y3ZdBk-ONLyjz0Lei6R-H7-VjcewevWome-iLMHDC-G5qo3D34KdsSu5M-qlXLQl2KI303wb22CY_oAHovTqoNY6KX6wA2K4yx2n9qKctrMlak9STsJn5qi4mZvppj5wVQyQs9X2AHrWc7uykAIw_mAqVJh1CEkhWhI0MNTTkzh0I0KYxRAyrc7vZZ85YpjxJRPH1PF3zj_zxj1yn4WkxSuEpdmsns737zlZ7WUHM1kJTJIAVMN3w3O2kDjetcuqLBZnPs8DUbO-uqhU83hgmv2xfwVG73VmyN1YuJY8dIB9AQnxP9M',
            'X-CSRF-TOKEN': document.cookie.split("TOKEN=")[1]
      },
      body: JSON.stringify(mydata)
    })
    .then((response) =>{
      return response.json()
    } )
    .then((data) => {
      console.log(data)
    })


  }
}

</script>
