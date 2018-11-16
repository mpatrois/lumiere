<template>
    <div class="comments">
        <input type="text" placeholder="Ajouter un commentaire">
        <div>
            <h3>TOP COMMENTAIRES</h3>
            <ul>
                <li class="comment" v-for="(comment, index) in comments" :key="index">
                    <div class="user-section">
                        <img :src="comment.user.url_avatar">
                        <div class="user-infos">
                            <h4>
                                {{comment.user.name}}
                                <span class="info-date">{{comment.date}}</span>
                            </h4>
                            <div class="comment-likes">
                                <span>{{comment.nbLikes}} likes</span>
                                <span>{{comment.nbComments}} commentaires</span>
                            </div>
                        </div>
                    </div>
                    <div class="comment-content">
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

$font-title: 'SG', Helvetica, 'Helvetica Neue', sans-serif;
$font-body: 'SF', Helvetica, 'Helvetica Neue', sans-serif;


.comments{
    background: #2E2F30;
    color:white;
    padding: 20px;
    font-family: $font-body;
    h3{
        // font-weight: 300;
        padding-bottom: 10px;
        font-size: 12.86px;
        font-weight: bold;
        line-height: 18px;
    }
    input{
        width: 100%;
        display: inline-block;
        background: transparent;
        border: 0px;
        border-bottom: 1px solid white;
        padding-bottom: 10px;
        color:white;
        outline: 0px;
        margin-bottom: 40px;
    }
    .comment{
        margin-bottom: 10px;
    }
    .user-section{
        text-align: left;
        display: flex;
        flex-direction: row;
        font-size: 12px;
        margin-bottom: 10px;
        img{
            // flex: 0;
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }
        .user-infos{
            padding: 0px 10px;
            h4{
                margin: 0px;

                // padding: 0px 10px;
            }
            .info-date{
                font-size: 9px;
                color: #979797;
                font-weight: 100;
                margin-left: 20px;
            }
            .comment-likes{
                margin-top: 2px;
                span{
                    font-size: 10px;
                    margin-right: 5px;
                    color: #979797;
                    font-weight: 100;
                }
            }
        }
    }
    .comment-content{
        font-size: 10px;
        font-family: "SF";
        line-height: 15px;
        font-weight: 100;
    }
}
</style>
