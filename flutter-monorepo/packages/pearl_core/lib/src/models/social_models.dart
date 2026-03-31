// ignore_for_file: invalid_annotation_target

class SocialPost {
  final String id;
  final SocialAuthor? author;
  final String content;
  final List<String> mediaUrls;
  final String? verticalTag;
  final String? listingId;
  final int likesCount;
  final int commentsCount;
  final bool isPinned;
  final DateTime createdAt;

  const SocialPost({
    required this.id,
    required this.author,
    required this.content,
    required this.mediaUrls,
    required this.verticalTag,
    required this.listingId,
    required this.likesCount,
    required this.commentsCount,
    required this.isPinned,
    required this.createdAt,
  });

  factory SocialPost.fromJson(Map<String, dynamic> json) => SocialPost(
        id: json['id'] as String,
        author: json['author'] != null
            ? SocialAuthor.fromJson(json['author'] as Map<String, dynamic>)
            : null,
        content: json['content'] as String,
        mediaUrls: (json['media_urls'] as List<dynamic>?)
                ?.map((e) => e as String)
                .toList() ??
            [],
        verticalTag: json['vertical_tag'] as String?,
        listingId: json['listing_id'] as String?,
        likesCount: (json['likes_count'] as num?)?.toInt() ?? 0,
        commentsCount: (json['comments_count'] as num?)?.toInt() ?? 0,
        isPinned: (json['is_pinned'] as bool?) ?? false,
        createdAt: DateTime.parse(json['created_at'] as String),
      );

  Map<String, dynamic> toJson() => {
        'id': id,
        'author': author?.toJson(),
        'content': content,
        'media_urls': mediaUrls,
        'vertical_tag': verticalTag,
        'listing_id': listingId,
        'likes_count': likesCount,
        'comments_count': commentsCount,
        'is_pinned': isPinned,
        'created_at': createdAt.toIso8601String(),
      };
}

class SocialAuthor {
  final String id;
  final String name;
  final String? photo;

  const SocialAuthor({
    required this.id,
    required this.name,
    this.photo,
  });

  factory SocialAuthor.fromJson(Map<String, dynamic> json) => SocialAuthor(
        id: json['id'] as String,
        name: json['name'] as String,
        photo: json['photo'] as String?,
      );

  Map<String, dynamic> toJson() => {
        'id': id,
        'name': name,
        'photo': photo,
      };
}

class SocialComment {
  final String id;
  final String postId;
  final SocialAuthor? author;
  final String body;
  final String? parentId;
  final DateTime createdAt;

  const SocialComment({
    required this.id,
    required this.postId,
    required this.author,
    required this.body,
    required this.parentId,
    required this.createdAt,
  });

  factory SocialComment.fromJson(Map<String, dynamic> json) => SocialComment(
        id: json['id'] as String,
        postId: json['post_id'] as String,
        author: json['author'] != null
            ? SocialAuthor.fromJson(json['author'] as Map<String, dynamic>)
            : null,
        body: json['body'] as String,
        parentId: json['parent_id'] as String?,
        createdAt: DateTime.parse(json['created_at'] as String),
      );
}

class SocialProfile {
  final String id;
  final String name;
  final String? photo;
  final int followersCount;
  final int followingCount;
  final int postsCount;
  final List<SocialPost> posts;

  const SocialProfile({
    required this.id,
    required this.name,
    required this.photo,
    required this.followersCount,
    required this.followingCount,
    required this.postsCount,
    required this.posts,
  });

  factory SocialProfile.fromJson(Map<String, dynamic> json) => SocialProfile(
        id: json['id'] as String,
        name: json['name'] as String,
        photo: json['photo'] as String?,
        followersCount: (json['followers_count'] as num?)?.toInt() ?? 0,
        followingCount: (json['following_count'] as num?)?.toInt() ?? 0,
        postsCount: (json['posts_count'] as num?)?.toInt() ?? 0,
        posts: ((json['posts']?['data'] ?? json['posts'] ?? []) as List<dynamic>)
            .map((e) => SocialPost.fromJson(e as Map<String, dynamic>))
            .toList(),
      );
}
