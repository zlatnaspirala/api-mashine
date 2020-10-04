
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
                      <input type="file" name="avatar" @change="validateImage($event);"
            accept="image/*" class="input-file">
              Drag your image file here to begin upload.
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

import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios)


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

  private ATOKEN = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImM1MmE5NmU4NTI0NDE1ZTJjN2E5MWE1YTEyMzI5NTFmZjVhMzYzN2FlNGU0NDMyYzM1YjkyMDM5NGRhNzU5YTEyM2E3YjNiNWJmNThlZjJlIn0.eyJhdWQiOiIxIiwianRpIjoiYzUyYTk2ZTg1MjQ0MTVlMmM3YTkxYTVhMTIzMjk1MWZmNWEzNjM3YWU0ZTQ0MzJjMzViOTIwMzk0ZGE3NTlhMTIzYTdiM2I1YmY1OGVmMmUiLCJpYXQiOjE2MDE4Mzc0NjUsIm5iZiI6MTYwMTgzNzQ2NSwiZXhwIjoxNjMzMzczNDY1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.nAxAIFaURrMsXcggNIML0VQ9MaXmeGncHKvrp920nJpXkjySuHYXbU6gIfA31NnVjzwfZMSkDhgJc70RTOJA52-eBdgXjqgFjDtfW9_z49X-seeI8f65KL8yiHx2WwuO1p-9izZdBLCLhDRS7t0lE1Ndd1D85U1NMzJuJjOM2OM8obKMaj2h6Ep4ZNZTb2vLFZNv3tTtJFZoQSOGgcDLGW9K-Kj7dXAwCPZaOeezq4QkTZoboleFx2ERdX0CKWamaVi89ADTYyd7vRcMNhmDmt6FprAqWg8MmTaYN5wVADLS4YRllUn7qX1s4C_Syr2oeXOrUD5fB_4Sy59GJgGJPj71XtPYza7E7cYOC7pFIwhNy9gmRLyNoC38UpeIGwbiJyHaonP7Jh69bISAUK43XlE-ezaWt8pLHhVz_xucoILpuOoPhUy69Kapw8RPqnOY2UfM3t1Nec9y-M-BITdjPAnCKI4qnFgAzOXAUaqabkoEv5v9RSbDX26rUEfoiFO6kLEfJ5ZZKlcfzlvxVgqU1G85TIhvyKjW081MNfHKrmBSLhbmRWKtjIdX3cjLn6pwiuC3U4LCEjeSjsz-OkdmITKqA3IREMEAR9dDoUfLCMXtkoFxH2AiCiTxGxSk4fbnMqdIFa52bNXsu7wssSN2J3n-asZtnD6-m_AGQSc8U-U"
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

    this.uploadMyAvatar (event.target.files)
    // this.uploadMyAvatar (event.target)


  }

  private getMyAvatar() {

    fetch('api/v1/avatars/2', {
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

    let formData2 = new FormData()
          formData2.append('avatar', fl[0], fl[0].name)
    try {
            let response = axios.post('http://localhost:8000/api/v1/avatars', formData2, {
              headers: {
                'Authorization': 'Bearer ' + this.ATOKEN,
                'Content-Type': 'multipart/form-data;boundary=*'
              }
         })
    } catch(err) {
      console.log(err)
    }
 /*
    var formData = new FormData()
    formData.append('avatar', fl[0], fl[0].name);

    fetch('api/v1/avatars', {
      method: 'POST',
      headers: {
        'Content-Type': 'multipart/form-data;boundary=*',
        'Accept': '*',
         // 'X-CSRF-TOKEN': document.cookie.split("TOKEN=")[1],
        'Authorization': 'Bearer ' + this.ATOKEN,
      },
      body: formData
    })
    .then((response) => {
      return response.json()
    })
    .then((data) => {
      if (typeof data.errors !== 'undefined') {
        console.error("Something wrong with posts feed initially request.")
        return;
      }
      this.$data.lastResponse = data
      console.log("this.$data.lastResponse => " + this.$data.lastResponse)
    })
   */
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
