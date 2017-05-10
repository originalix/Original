const Foo = { template: '<div>foo</div>' }
const Bar = { template: '<div>Bar</div>' }
// const User = { template: '<div>User {{ $route.params.id }} </div>'}
// const UserNest = { template: '<div class="user"><h1>UserNest {{ $route.params.id }}</h1><router-view></router-view></div>'
// }
const User = {
  template: `
    <div class="user">
      <h2>User {{ $route.params.id }}</h2>
      <router-view></router-view>
    </div>
  `
}

const UserHome = { template: '<div>Home</div>' }
const UserProfile = { template: '<div>Profile</div>' }
const UserPosts = { template: '<div>Posts</div>' }

const routes = [
    { path: '/foo', component: Foo },
    { path: '/bar', component: Bar },
    { path: '/user/:id', component: User },
    { path: '/user/:id/posts', component: UserPosts }

]

const router = new VueRouter({
    routes: [
        { path: '/user/:id', component: User,
          children: [
            {
                path: 'posts',
                component: UserPosts
            }
          ]
        }
    ]
})



const app = new Vue({
    router
}).$mount('#app')