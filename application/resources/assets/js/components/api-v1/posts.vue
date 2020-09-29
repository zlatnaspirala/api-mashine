
<template>
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

      <md-table v-bind:style="styleTableObject" md-card >
        <md-table-toolbar>
          <h2 class="md-title">Feed data:</h2>
        </md-table-toolbar>
        <md-table-row :key="value.id" md-selectable="single"
            slot="md-table-row" :slot-scope="lastResponse.data"
            v-for="value in lastResponse.data">
          <md-table-cell  md-label="Title" md-sort-by="title" >
              {{ value.attributes.title }}
          </md-table-cell>
          <md-table-cell md-label="Content" md-sort-by="content" >
              {{ value.attributes.content }}
          </md-table-cell>
          <md-table-cell md-label="VideoId" md-sort-by="videoId">
            {{ value.attributes['created-at'] }}
            </md-table-cell>
        </md-table-row >

        <md-toolbar class="md-toolbar-feed" >
              <md-button class="md-prioryty md-raised paginatorBtns" @click="navigateToFirst">
                first
              </md-button>
              <md-button class="md-prioryty md-raised paginatorBtns" @click="navigateToNext">
                next
              </md-button>
              <md-button class="md-prioryty md-raised paginatorBtns" @click="navigateToLast">
                last
              </md-button>
        </md-toolbar>

      </md-table>
    </div>

    <form novalidate class="md-layout" @submit.prevent="validateImage">
      <md-field>
        <md-input type="file" @change="validateImage($event)" />
      </md-field>
    </form>

      <form enctype="multipart/form-data" novalidate id="uploadForm" >
        <h1>Upload images</h1>
        <div class="dropbox">
          <input type="file" name="file" @change="validateImage($event);"
            accept="image/*" class="input-file">
              Drag your file(s) here to begin<br> or click to browse
        </div>
      </form>

      <md-button class="md-prioryty md-raised paginatorBtns" @click="getMyAvatar">
        GET AVATAR 1
      </md-button>

      <md-button class="md-prioryty md-raised paginatorBtns" @click="getMyAvatars">
        GET AVATARS
      </md-button>

  </div>

</template>

<style scoped>

.md-title {
  padding-bottom: 0%;
}

.md-toolbar-create-post {
  margin-bottom: 2%;
}

.md-toolbar-feed {
  width: 100%;
  flex-flow: nowrap;
  margin-bottom: 0.5%;
}

.paginatorBtns {
  flex-flow: initial;
  width: -webkit-fill-available;
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
    mdToolbar
  }
})

@Component
export default class postsComponent extends Vue {

  private name = "posts-component"

  private ATOKEN = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjUxMjMxOWFjYmM3OTExZmNiOGE1Y2FjN2Q3MTJlMzlmMGExNGVmNDgyNmY0MjRkMmMyZGY1YWE5NjlhZDRkZjYxN2FjNjUwYjEyNjFiOTgzIn0.eyJhdWQiOiIxIiwianRpIjoiNTEyMzE5YWNiYzc5MTFmY2I4YTVjYWM3ZDcxMmUzOWYwYTE0ZWY0ODI2ZjQyNGQyYzJkZjVhYTk2OWFkNGRmNjE3YWM2NTBiMTI2MWI5ODMiLCJpYXQiOjE2MDEyODcwNzEsIm5iZiI6MTYwMTI4NzA3MSwiZXhwIjoxNjMyODIzMDcxLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.OR8q5m4ld7xziLUF0j6_riVFmfSFapVhPCS0V2ZTBrCWpxF6Ar-EAHiJFPM_UAMJLbSwH-Ae_LwuFVbFmSLp7nbz9sjGQizIZN3wTzCyaspb31ksGZJ_1waM0qmQ7O6-kCZB0Utn7f5j7aQzc_nwrXJMmg0T2b_83hTDdLX6GblRn7GJZ3yoYhpVxTl0qpdYak5bIW24MwcLICCcaBw07K1krX2Z_z5NG70xE6sGRgpvijMazWnIAEz0hlY1V62nS9HyggBD9hil60MgYv5L4YWvuJerU3n0AlYtl5rfNAo_3PIsgvpaHzDfuNahV-AubLjNfC7PPegGAsCTRV-jeK42fU0Ke51MW06xBoZxkpjA8tnZR-OAtZX-D-wM7UhFUtN3PNNvbOQAc0VPzNM_1tOGZbwxEX31jRgacaD_NK7nnBYdwxiRLQJvqtJixbA0OMBuqac1741RHtcoORIzHQZ6a5mnhXtfyiRaIMSVn8BzF7dxAi0N-dwBygLFygXkXsXlGFyVVBM0cuFbBLh3KkfaxUpevVEqP3VXSVEtCR81i5RRq3Z4md0wd88m2-vxP_f1YbaUQb1JaULLiZQHLl1_j718keeyhc8_E3Cu51P0g27N900DJwfIWmR-mMYNckIKLmfA94ZDYHFyMh9eMIT7wHkCCtQuPBZX9mSfoJc"
  private postformVisibility: boolean = true
  private feedformVisibility: boolean = false

  private myAvatar = "no  image";

  private lastResponse: any = {
    data: []
  }

  public styleContent = {
    padding: "2%",
    border: "solid orange 1px"
  }

  private styleTableObject: Partial<CSSStyleDeclaration> = {
    width: '100%',
    height: '76%'
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
   * @description Test avatar image route
   * Request =>
   *  GET /api/v1/avatars/1 HTTP/1.1
   *  Accept: image/*
   *
   * Upload =>
   *  POST /api/v1/avatars HTTP/1.1
   *  Accept: application/vnd.api+json
   *  Content-Type: mutlipart/form-data
   */

  validateImage(event) {

    console.log("validateImage .. ", event.target)

    this.uploadMyAvatar (event.target.files[0])
    // this.uploadMyAvatar (event.target)


  }

  private getMyAvatar() {

    fetch('api/v1/avatars/1', {
      method: 'GET',
      headers: {
        'Content-Type': '*',
        'Accept': 'image/jpeg',
        'X-CSRF-TOKEN': document.cookie.split("TOKEN=")[1]
      }
    })
    .then((response) =>{
      // return response.json()
      console.log('GOOOOD', response)
    } )
    /* .then((data) => {

      if (typeof data.errors !== 'undefined') {
        console.error("Something wrong with posts feed initially request.")
        return;
      }

      // this.$data.lastResponse = data
      // console.log("this.$data.lastResponse => " + this.$data.lastResponse)
    })
*/
  }


  private getMyAvatars() {

    fetch('api/v1/avatars', {
      method: 'GET',
      headers: {
        'Content-Type': '*',
        'Accept': '*/*',
        'X-CSRF-TOKEN': document.cookie.split("TOKEN=")[1]
      }
    })
    .then((response) =>{
      return response.json()
    } )
    .then((data) => {
      if (typeof data.errors !== 'undefined') {
        console.error("Something wrong with posts feed initially request.")
        return;
      }

      // this.$data.lastResponse = data
      // console.log("this.$data.lastResponse => " + this.$data.lastResponse)
    })

  }

  private uploadMyAvatar(fl) {

    console.log("WHAT IS ")
    console.log("WHAT IS ", fl)

    var f = document.getElementById("uploadForm") as HTMLFormElement

    var formData = new FormData()
    formData.append("avatar", fl)

    console.log(" AVATAR eha is f ", f)

    // formData.append("avatar", fl)
    // formData.append("avatar", null)

    var mydata =  {
      "data" : {
          "type": "avatars",
          "avatar": "test",
          "attributes": {
              "media_type": 'image/jpg',
          }
        },
     }


    //    var mydata =  { "avatar": fl };

    fetch('api/v1/avatars', {
      method: 'POST',
      headers: {
        // 'Content-Type': 'multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW', // boundary=* WebKitFormBoundary3pvkBL1AgVlyftxh
        // 'Content-Type': 'multipart/form-data; boundary=----WebKitFormBoundary*', // boundary=* WebKitFormBoundary3pvkBL1AgVlyftxh
        'Content-Type': 'multipart/form-data;boundary=*',
        'Accept': 'application/vnd.api+json',
        'X-CSRF-TOKEN': document.cookie.split("TOKEN=")[1],
        'Authorization': 'Bearer ' + this.ATOKEN,
      },
      body: formData // formData // JSON.stringify(formData)// formData //
    })
    .then((response) =>{
      return response.json()
    } )
    .then((data) => {
      if (typeof data.errors !== 'undefined') {
        console.error("Something wrong with posts feed initially request.")
        return;
      }

      this.$data.lastResponse = data
      console.log("this.$data.lastResponse => " + this.$data.lastResponse)
    })



  }

  /**
   * @description Navigate for table paginator.
   */
  private navigateToFirst() {
    this.getPostsFeedData(this.$data.lastResponse.links.first)
  }

  private navigateToNext() {
    this.getPostsFeedData(this.$data.lastResponse.links.next)
  }

  private navigateToLast() {
    this.getPostsFeedData(this.$data.lastResponse.links.last)
  }

  /**
   * @description Swithc between two main components
   *  - CreateFormPost
   *  - FeedFormPosts
   */
  private hideCreateFormPost() {

    this.$data.postformVisibility = false
    this.$data.feedformVisibility = true

  }

  /**
   * @description Clear error style from edited field.
   */
  titleChanged() {
    this.$data.error.titleError = false
  }

  postIdChanged() {
    this.$data.error.postIdError = false
  }

  contentChanged() {
    this.$data.error.contentError = false
  }
  /**
   * @description From here we can use DOM refs
   */
  private mounted() {

    console.info('Post component mounted.')

    this.getPostsFeedData()
    this.getMyAvatar()

  }

  private created() {
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
          'Authorization': 'Bearer ' + this.ATOKEN,
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

  getPostsFeedData(arg?) {

    var currentArg = '/api/v1/posts';

    if (typeof arg !== 'undefined') {
      currentArg = arg
    }

    fetch(currentArg, {
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
      if (typeof data.errors !== 'undefined') {
        console.error("Something wrong with posts feed initially request.")
        return;
      }

      this.$data.lastResponse = data
      console.log("this.$data.lastResponse => " + this.$data.lastResponse)
    })
  }

}

</script>
