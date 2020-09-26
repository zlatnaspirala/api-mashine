
<template>
<!-- @keyup.enter="execute()"    class="md-primary md-raised" -->

<div>

  <div :style="styleContent" v-show="postformVisibility">

    <md-toolbar class="md-toolbar">
      <h3 class="md-title">Create post</h3>
    </md-toolbar>
    <md-field class="md-content-options" :class="{'md-invalid': error.titleError}">
      <label class="labelText" >Post title</label>
      <md-input
              v-on:change="titleChanged"
              v-model="currentPost.title"
              class="md-primary md-raised"
              placeholder="Title: "
              maxlength="70">
      </md-input>
      <span class="md-error"> {{ error.titleErrorMsg }} </span>
    </md-field>
    <md-field class="md-content-options" :class="{'md-invalid': error.postIdError}" >
      <label class="labelText" >id post</label>
      <md-input required
              v-on:change="postIdChanged"
              v-model="currentPost.postId"
              class="md-primary md-raised"
              placeholder="Uniq post id"
              maxlength="100">
      </md-input>
      <span class="md-error"> {{ error.postIdErrorMsg }} </span>
    </md-field>
    <md-field class="md-content-options" :class="{'md-invalid': error.contentError}" >
      <label class="labelText" >Content</label>
      <md-textarea
              v-on:change="contentChanged"
              v-model="currentPost.content"
              class="md-primary md-raised"
              placeholder="CONTENT"
              maxlength="200">
      </md-textarea>
      <span class="md-error"> {{ error.contentErrorMsg }} </span>
    </md-field>

    <md-button class="md-prioryty md-raised" @click="createPost">
      PUBLISH
    </md-button>

    <md-button class="md-prioryty md-raised" @click="hideCreateFormPost">
      HIDE
    </md-button>

  </div>


  <div :style="styleContent" v-show="feedformVisibility">

    <md-table v-bind:style="styleTableObject" md-card v-show='tyfetchVisibility' >
      <md-table-toolbar>
        <h2 class="md-title">Feed data:</h2>
      </md-table-toolbar>
      <md-table-row :key="value" md-selectable="single"
          slot="md-table-row" :slot-scope="lastResponse.data"
          v-for="value in lastResponse.data">
        <md-table-cell  md-label="VideoId" md-sort-by="VideoId" >
            {{ value.id.kind }}
        </md-table-cell>
        <md-table-cell md-label="Title" md-sort-by="title" >
                   {{ value.title }}
        </md-table-cell>
        <md-table-cell md-label="VideoId" md-sort-by="videoId">
          {{ value.id }}
          </md-table-cell>
      </md-table-row >
    </md-table>
    </div>

</div>

</template>

<style scoped>

.md-title {
  padding-bottom: 0%;
}

.md-toolbar {
  margin-bottom: 2%;
}
</style>

<script lang="ts">

import Component from 'vue-class-component'
import Vue from 'vue';
import VueMaterial from 'vue-material'
  import { mdButton,
           mdInput,
           mdField,
           mdContent,
           mdTextarea,
           mdToolbar
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
    mdContent,
    mdTextarea,
    // mdToolbar
  }
})

@Component
export default class postsComponent extends Vue {

  private name = "posts-component"
  private postformVisibility: boolean = true
  private feedformVisibility: boolean = false

  public styleContent = {
    padding: "2%",
    border: "solid orange 1px"
  }

  private styleTableObject: Partial<CSSStyleDeclaration> = {
    width: '100%',
    height: '76%'
  }

  constructor() {
    super()
  }

  data() {
    return {
      currentPost: {
        title: "hello world",
        postId: "hello-world",
        content: "First share, i share post . "
      },
      error: {
        titleError: false,
        postIdError: false,
        contentError: false,
        titleErrorMsg: "titleError",
        postIdErrorMsg: "postIdError",
        contentErrorMsg: "contentError"
      }
    }
  }

  /**
   * @description Swithc between two main components
   *  - CreateFormPost
   *  - WallFormPosts
   */

  private hideCreateFormPost() {

    this.$data.postformVisibility = false
    this.$data.feedformVisibility = true

  }

  /**
   * @description Clear error style from edited field.
   */
  titleChanged () {
    this.$data.error.titleError = false
  }

  postIdChanged () {
    this.$data.error.postIdError = false
  }

  contentChanged () {
    this.$data.error.contentError = false
  }
  /**
   * @description From here we can use DOM refs
   */
  mounted() {
    console.info('Post component mounted.')

    this.getPostsFeedData()
  }

  getPostById(id: number) {

    var root = this;

    fetch('/api/v1/posts/' + id, {
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

  createPost() {

    var root = this;

    var mydata =  {
      "data" : {
          "type": "posts",
          "attributes": {
              "title": this.$data.currentPost.title,
              "slug": this.$data.currentPost.postId,
              "content": this.$data.currentPost.content
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
    .then((response) => {

      return response.json()

    } )
    .then((data) => {

      if (typeof data.errors !== 'undefined') {
        data.errors.forEach(error => {

          console.log("Error => ", error.detail)
          if (error.detail === "The title field is required.") {
            root.$data.error.titleError = true
            root.$data.error.titleErrorMsg = error.detail
          } else if (error.detail === "The slug has already been taken.") {
            root.$data.error.postIdError = true
            root.$data.error.postIdErrorMsg = error.detail
          } else if (error.detail === "The content field is required.") {
            root.$data.error.contentError = true
            root.$data.error.contentErrorMsg = error.detail
          } else {
            alert("UNHANDLED error" + error.detail)
          }

        });
      } else {
        console.log(data)
      }

    })

  }

  getPostsFeedData() {

    fetch('/api/v1/posts', {
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

}

</script>
