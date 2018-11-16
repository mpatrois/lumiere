<template>
    <div class="comments">
        <input type="text" placeholder="ajouter un commentaire">
        <div>
            <h3>TOP COMMENTAIRE</h3>
            <ul>
                <li v-for="(comment, index) in comments" :key="index">
                    <div class="user-section">
                        <img :src="comment.user.url_avatar">
                        <div class="user-infos">
                            <h4>
                                {{comment.user.name}}
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
.comments{
    background: #2E2F30;
    color:white;
    h3{
        font-weight: 700;
    }
    .user-section{
        display: flex;
        flex-direction: row;
        img{
            // flex: 0;
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }
        .user-infos{
            h4{
                margin: 0px;
                padding: 0px 10px;
            }
        }
    }
}
</style>
