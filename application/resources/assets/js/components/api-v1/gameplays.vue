
<template>
<div>

  <md-field class="md-content-options">
    <label class="labelText" >Share post</label>
    <md-input
            @keyup.enter="execute()"
            v-model="yts.mySearchQuery"
            class="md-primary md-raised"
            placeholder="Search youtube:"
            maxlength="1200">
    </md-input>
  </md-field>

  <md-button class="md-prioryty md-raised" @click="postMyGameplay">
    POST
  </md-button>
  <md-button class="md-prioryty md-raised" @click="postMyPost">
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
export default class gameplaysComponent extends Vue {

  public name = "gameplays-component"

  constructor() {
    super()
  }

  data() {
    return {
      "currentPost": {
        title: "hello world",
        postId: "hello-world",
        content: "First share, i share post . "
      }
    }
  }

  mounted() {
    console.info('Post component mounted.')
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
            'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjNjZmMwZmYzMjdjMWQwMzhkNjA5YmJjYmViM2E5YTRhMzI0ZWI1NzI2YmNiYWJmNTk4OWExNGI0NDJhM2FlNGU2MmY2OGQ1ZTM2ZGI1OWE3In0.eyJhdWQiOiIxIiwianRpIjoiM2NmYzBmZjMyN2MxZDAzOGQ2MDliYmNiZWIzYTlhNGEzMjRlYjU3MjZiY2JhYmY1OTg5YTE0YjQ0MmEzYWU0ZTYyZjY4ZDVlMzZkYjU5YTciLCJpYXQiOjE2MDA5NTc5NjgsIm5iZiI6MTYwMDk1Nzk2OCwiZXhwIjoxNjMyNDkzOTY4LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.PYXDgFt8s2Izrnc-Lin5c4PaOjPAV3sYBToe9s0sDqY8OMY4MTDA2Vvu0IpaJLX26XPpW3-DK1pBAzPU4vywQK9kM6i4XM28UZvexfj1fvaO_17qMMW3hn3kXDTMKPPPCj7P98DoESk7mSEucDfr_lUcUmNw48jrATfehSS5DojSakrZhyBkOmo1LJL9jBS6eQh6l3eAg3gPNweE8y0i4SEXchf94eV6vGqQhbH9pjNm4qBs-4KVLYoalSaTLVNqna3JqI2lpSklcciEaAwDCZ-3tAxWNkLFwjghKEDIq46I5zueljGIFnMfGo2eCyrOC1KFTcqPuYxAgOW2Xu_0cwugHI1E-8EtE177XMVUIpiX0ReBCcErS7MEbUZdMMmm4gV06XuSfefUrrWjW1oPfC8rbJLKD1SeDoAsudJ4vBuM3kMdys39gIIbEmfqjBu_yv3NMjPWAhjenW6-DghrOko61_nZ3TlWTqClU2h9TILU9pIBzoJBcUkQ9oYdSqPquzoO5qHWXNrA2VbwnkVP-wWsYZEGUrex24_rHzHH8JvRzDovl2_R4vfnRC4JHaFtyFOVKXtAHy_WubSd4g-yIVH9afRu-DhFnaw1Lm5rdm1LaNTKOaefDT68ONS7A_lkZcUColh2L54ASzG-rmN7d2B1oWbty50k_8uE_3pTrhs',
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
          'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjNjZmMwZmYzMjdjMWQwMzhkNjA5YmJjYmViM2E5YTRhMzI0ZWI1NzI2YmNiYWJmNTk4OWExNGI0NDJhM2FlNGU2MmY2OGQ1ZTM2ZGI1OWE3In0.eyJhdWQiOiIxIiwianRpIjoiM2NmYzBmZjMyN2MxZDAzOGQ2MDliYmNiZWIzYTlhNGEzMjRlYjU3MjZiY2JhYmY1OTg5YTE0YjQ0MmEzYWU0ZTYyZjY4ZDVlMzZkYjU5YTciLCJpYXQiOjE2MDA5NTc5NjgsIm5iZiI6MTYwMDk1Nzk2OCwiZXhwIjoxNjMyNDkzOTY4LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.PYXDgFt8s2Izrnc-Lin5c4PaOjPAV3sYBToe9s0sDqY8OMY4MTDA2Vvu0IpaJLX26XPpW3-DK1pBAzPU4vywQK9kM6i4XM28UZvexfj1fvaO_17qMMW3hn3kXDTMKPPPCj7P98DoESk7mSEucDfr_lUcUmNw48jrATfehSS5DojSakrZhyBkOmo1LJL9jBS6eQh6l3eAg3gPNweE8y0i4SEXchf94eV6vGqQhbH9pjNm4qBs-4KVLYoalSaTLVNqna3JqI2lpSklcciEaAwDCZ-3tAxWNkLFwjghKEDIq46I5zueljGIFnMfGo2eCyrOC1KFTcqPuYxAgOW2Xu_0cwugHI1E-8EtE177XMVUIpiX0ReBCcErS7MEbUZdMMmm4gV06XuSfefUrrWjW1oPfC8rbJLKD1SeDoAsudJ4vBuM3kMdys39gIIbEmfqjBu_yv3NMjPWAhjenW6-DghrOko61_nZ3TlWTqClU2h9TILU9pIBzoJBcUkQ9oYdSqPquzoO5qHWXNrA2VbwnkVP-wWsYZEGUrex24_rHzHH8JvRzDovl2_R4vfnRC4JHaFtyFOVKXtAHy_WubSd4g-yIVH9afRu-DhFnaw1Lm5rdm1LaNTKOaefDT68ONS7A_lkZcUColh2L54ASzG-rmN7d2B1oWbty50k_8uE_3pTrhs',
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
