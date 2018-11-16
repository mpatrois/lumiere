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
