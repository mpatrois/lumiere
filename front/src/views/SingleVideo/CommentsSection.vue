<template>
    <div class="comment">
        <input type="text" placeholder="ajouter un commentaire">
        <div>
            <h3>TOP COMMENTAIRE</h3>
            <ul>
                <li v-for="(comment, index) in comments" :key="index">
                    <div class="user-section">
                        <img :src="comment.user.url_avatar">
                        <div class="user-infos">
                            <h4>
                                {{user.name}}
                                <span>{{comment.date}}</span>
                            </h4>
                            <div>
                                <span>{{comment.nbComments}}</span>
                                <span>{{comment.nbLikes}}</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        {{comment.content}}
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script style="scss" scoped>
export default {
  props: ['comments'],
};
</script>

<style lang="scss">
.comment{
    h3{
        font-weight: 700;
    }
    .user-section{
        display: flex;
        img{
            // flex: 0;
        }
        .user-infos{

        }
    }
}
</style>
