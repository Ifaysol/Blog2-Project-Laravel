<div class="mb-2">
    <label class="block" for="post">Post</label>
    <input type="text" name="post" value="{{old('post', isset($blog) ? $blog->post : '')}}" id="post" class="focus">
    <p class="text-red-600">{{$errors->first("post")}}</p>
</div>
<div class="mb-2">
    @isset($post)
        <img src="{{asset('images/blog/' .$post->image)}}" alt="image">
    @endisset
    <label class="block" for="image">Upload Image</label>
    <input type="file" name="image"  id="image" class="focus">
    <p class="text-red-600">{{$errors->first("image")}}</p>
</div>
<div>
    <button class="px-4 py-2 bg-gray-600" type="submit">{{$buttonText}}</button>
</div>