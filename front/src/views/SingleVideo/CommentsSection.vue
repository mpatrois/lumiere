<template>
    <div class="singleVideo__video__content__comments">
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
                    <ul class="reactions-buttons">
                        <li>
                            <span>❤️</span>
                        </li>
                        <li>
                            <img src="../../assets/shape.png" class="logo">
                        </li>
                    </ul>
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
    .reactions-buttons{
        li{
            border: 1px solid white;
            border-radius: 50%;
            -webkit-transition: opacity 0.5s ease;
            transition: opacity 0.5s ease;
            opacity: 0.7;
            height: 20px;
            width: 20px;
            margin-top: 4px;
            cursor: pointer;
            position: relative;
            display: inline-block;
            margin-right: 10px;
            span{
                font-size: 9px;
                vertical-align: middle;
                display: inline-block;
                position: absolute;
                top: 50%;
                left: 50%;
                line-height: normal;
                transform: translateX(-50%) translateY(-50%);
            }
            img{
                border-radius: 0px;
                width: 9px;
                height: 9px;
                vertical-align: middle;
                display: inline-block;
                position: absolute;
                top: 50%;
                left: 50%;
                line-height: normal;
                transform: translateX(-50%) translateY(-50%);
            }
        }
    }
}

</style>
