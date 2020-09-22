<template>
  <div>
    <md-button class="md-prioryty md-raised" @click="testAdmin">
      TEST ADMION POST GET
    </md-button>
    <md-button class="md-prioryty md-raised" @click="testRun">
      TEST NORMAL POST GET
    </md-button>
  </div>
</template>

<script lang="ts">
import Component from "vue-class-component";
import Vue from "vue";
import VueMaterial from "vue-material";
import { mdButton, mdInput, mdField, mdContent } from "vue-material";

Vue.use(VueMaterial);

import "vue-material/dist/vue-material.min.css";
import "vue-material/dist/theme/default.css";

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
  public name = "my-component";

  constructor() {
    super();
  }

  data() {
    return {
      postMashine: {}
    };
  }

  mounted() {
    this.prepareComponent();
  }

  prepareComponent() {
    console.log("My component loaded...");
    // this.testRun()
  }

  testAdmin() {
    fetch("/api/v1/posts", {
      method: "GET",
      headers: {
        "Content-Type": "*",
        Accept: "application/json, text/plain, */*",
        "X-CSRF-TOKEN": document.cookie.split("TOKEN=")[1]
        // 'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQ1MzhmMzdiYmE1NDU4NTA0YWY0NzE3MWJlYjlkZTBjNjYyYjlmZTM5ZmNiZTU5M2I5M2VjNjgxNGI4ODkwNWQzZjE3NmRmMDk5Y2M4Yzg3In0.eyJhdWQiOiIyIiwianRpIjoiZDUzOGYzN2JiYTU0NTg1MDRhZjQ3MTcxYmViOWRlMGM2NjJiOWZlMzlmY2JlNTkzYjkzZWM2ODE0Yjg4OTA1ZDNmMTc2ZGYwOTljYzhjODciLCJpYXQiOjE2MDA0NzQyMTUsIm5iZiI6MTYwMDQ3NDIxNSwiZXhwIjoxNjMyMDEwMjE1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.HId8yWDDEqXYo48SuK-y2sXnFktpCz-5i9vgchtlFa7rwBcoVgNRBg0fOEw0nqQz2PAtMXBoihJqhjuAaRrFh76LyT_RnPZegIETrFn7YQSDYcwTeLFsTA5iReESt0Z2sNKSzaUFOTNekumSOHuqkx9tftl4FF6TFRtGJ9Z7FSFEi2dbC6pyjngin0Y02DyrzzTF6guvtwosU4CvlXmyG6UKOFeke4SWZ_Qikcmuu5ygy62feIMNqyOr0NW_88JVqtwQNl2fLwJaZ1FaRVxxzR4R3rZNGFhDkN7AOnudD2MYIOzZV7as-A6a1zkrIHoohhS14bvZRfpp-OB_S-go9bUBlceBIrBsia4RhCXwvNCEDAmvyNS3QJT12N_KhDH1emEyMHK2ZcREcr6nLuj21ce4dQkCBepY4T4ysVOIcxgi0rInTrbBXRpLgZ0PHPolM7RLivKmWTJw3oopfmcaOY7f6vLAZaEfoBBUpo2asJ5JxEGYHHj_5aJWhNHSTxqPlv55yTsAjz0apJ_yfGGczJ7PRfOW-c-h3BQxNGwTV-H1grbtYM7jeb2HCa0tzqzu6V05Y7AbinL59d1Sd23HU3k5YCLZdMHR6cU5wyWxDEbHyvl7gZu9iinSuQrKWmqz9avyrJhVIlVWlsqSynCZDc--DjqSzvS-5cJ3p6yHC00'
      }
      // body: JSON.stringify(root.data.data) // body data type must match "Content-Type" header
    })
      .then(response => {
        return response.json();
      })
      .then(data => {
        console.log(data);
      });
  }

  getMyPost() {
    fetch("/api/v1/posts/1", {
      method: "GET",
      headers: {
        "Content-Type": "*",
        Accept: "application/json, text/plain, */*",
        "X-CSRF-TOKEN": document.cookie.split("TOKEN=")[1]
        // 'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQ1MzhmMzdiYmE1NDU4NTA0YWY0NzE3MWJlYjlkZTBjNjYyYjlmZTM5ZmNiZTU5M2I5M2VjNjgxNGI4ODkwNWQzZjE3NmRmMDk5Y2M4Yzg3In0.eyJhdWQiOiIyIiwianRpIjoiZDUzOGYzN2JiYTU0NTg1MDRhZjQ3MTcxYmViOWRlMGM2NjJiOWZlMzlmY2JlNTkzYjkzZWM2ODE0Yjg4OTA1ZDNmMTc2ZGYwOTljYzhjODciLCJpYXQiOjE2MDA0NzQyMTUsIm5iZiI6MTYwMDQ3NDIxNSwiZXhwIjoxNjMyMDEwMjE1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.HId8yWDDEqXYo48SuK-y2sXnFktpCz-5i9vgchtlFa7rwBcoVgNRBg0fOEw0nqQz2PAtMXBoihJqhjuAaRrFh76LyT_RnPZegIETrFn7YQSDYcwTeLFsTA5iReESt0Z2sNKSzaUFOTNekumSOHuqkx9tftl4FF6TFRtGJ9Z7FSFEi2dbC6pyjngin0Y02DyrzzTF6guvtwosU4CvlXmyG6UKOFeke4SWZ_Qikcmuu5ygy62feIMNqyOr0NW_88JVqtwQNl2fLwJaZ1FaRVxxzR4R3rZNGFhDkN7AOnudD2MYIOzZV7as-A6a1zkrIHoohhS14bvZRfpp-OB_S-go9bUBlceBIrBsia4RhCXwvNCEDAmvyNS3QJT12N_KhDH1emEyMHK2ZcREcr6nLuj21ce4dQkCBepY4T4ysVOIcxgi0rInTrbBXRpLgZ0PHPolM7RLivKmWTJw3oopfmcaOY7f6vLAZaEfoBBUpo2asJ5JxEGYHHj_5aJWhNHSTxqPlv55yTsAjz0apJ_yfGGczJ7PRfOW-c-h3BQxNGwTV-H1grbtYM7jeb2HCa0tzqzu6V05Y7AbinL59d1Sd23HU3k5YCLZdMHR6cU5wyWxDEbHyvl7gZu9iinSuQrKWmqz9avyrJhVIlVWlsqSynCZDc--DjqSzvS-5cJ3p6yHC00'
      }
      // body: JSON.stringify(root.data.data) // body data type must match "Content-Type" header
    })
      .then(response => {
        return response.json();
      })
      .then(data => {
        console.log(data);
      });
  }
  testRun() {
    var root = this;

    console.log("test run");

    var mydata = {
      data: {
        type: "posts",
        attributes: {
          title: "My First Post",
          slug: "nikola-test2",
          content: " blabla dfgdfg"
        },
        links: {
          self: "https://localhost/api/v1/posts/"
        }
      }
    };

    fetch("/api/v1/posts", {
      method: "POST",
      headers: {
        "Content-Type": "application/vnd.api+json",
        Accept: "*/*",
        // 'Content-Type': 'application/vnd.api+json',
        // 'Accept': 'application/vnd.api+json',
        Authorization:
          "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImQ1MzhmMzdiYmE1NDU4NTA0YWY0NzE3MWJlYjlkZTBjNjYyYjlmZTM5ZmNiZTU5M2I5M2VjNjgxNGI4ODkwNWQzZjE3NmRmMDk5Y2M4Yzg3In0.eyJhdWQiOiIyIiwianRpIjoiZDUzOGYzN2JiYTU0NTg1MDRhZjQ3MTcxYmViOWRlMGM2NjJiOWZlMzlmY2JlNTkzYjkzZWM2ODE0Yjg4OTA1ZDNmMTc2ZGYwOTljYzhjODciLCJpYXQiOjE2MDA0NzQyMTUsIm5iZiI6MTYwMDQ3NDIxNSwiZXhwIjoxNjMyMDEwMjE1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.HId8yWDDEqXYo48SuK-y2sXnFktpCz-5i9vgchtlFa7rwBcoVgNRBg0fOEw0nqQz2PAtMXBoihJqhjuAaRrFh76LyT_RnPZegIETrFn7YQSDYcwTeLFsTA5iReESt0Z2sNKSzaUFOTNekumSOHuqkx9tftl4FF6TFRtGJ9Z7FSFEi2dbC6pyjngin0Y02DyrzzTF6guvtwosU4CvlXmyG6UKOFeke4SWZ_Qikcmuu5ygy62feIMNqyOr0NW_88JVqtwQNl2fLwJaZ1FaRVxxzR4R3rZNGFhDkN7AOnudD2MYIOzZV7as-A6a1zkrIHoohhS14bvZRfpp-OB_S-go9bUBlceBIrBsia4RhCXwvNCEDAmvyNS3QJT12N_KhDH1emEyMHK2ZcREcr6nLuj21ce4dQkCBepY4T4ysVOIcxgi0rInTrbBXRpLgZ0PHPolM7RLivKmWTJw3oopfmcaOY7f6vLAZaEfoBBUpo2asJ5JxEGYHHj_5aJWhNHSTxqPlv55yTsAjz0apJ_yfGGczJ7PRfOW-c-h3BQxNGwTV-H1grbtYM7jeb2HCa0tzqzu6V05Y7AbinL59d1Sd23HU3k5YCLZdMHR6cU5wyWxDEbHyvl7gZu9iinSuQrKWmqz9avyrJhVIlVWlsqSynCZDc--DjqSzvS-5cJ3p6yHC00",
        "X-CSRF-TOKEN": document.cookie.split("TOKEN=")[1]
      },
      body: JSON.stringify(mydata)
    })
      .then(response => {
        return response.json();
      })
      .then(data => {
        console.log(data);
      });
  }
}
</script>
