{{-- call header and footer --}}
@extends('admin.layouts.main')
@section('title',  'Edit berita')

@section('content')

<body>
    <div class="wrapper">
        {{-- call header --}}
        @include('admin.layouts.header')
        {{-- call sidebar --}}
        @include('admin.layouts.sidebar')

        <div class="main-panel">
			<div class="content">
                <div class="panel-header bg-primary-gradient">
                    <div class="page-inner py-5">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            <div>
                                <h2 class="text-white pb-2 fw-bold"></h2>
                                <h5 class="text-white op-7 mb-2"></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <div class="row">
						<div class="col-md-8">
							<div class="card">
                                <div class="card-header card-info">
                                    <div class="card-title">Form edit berita</div>
                                </div>
								<div class="card-body">
                                <form action="{{ route('admin.news.update', ['news' => $news->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="title_id">Judul berita</label>
                                        <input type="text" class="form-control" id="title_id" name="title_id" placeholder="Tuliskan judul berita" value="{{ old('title_id', $news->title_id) }}">
                                        @error('title_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="title_en">Judul berita (English)</label>
                                        <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Judul berita bahasa inggris" value="{{ old('title_en', $news->title_en) }}">
                                        @error('title_en') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div> --}}
                                    <div class="form-group row">
                                        <div class="form-group col-md">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" class="form-control" id="tanggal" name="date" value="{{ old('date', date('Y-m-d', strtotime( $news->date))) }}">
                                            @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="form-group col-md">
                                            <label for="date">Kategori Berita</label>
                                            <select class="form-control" name="category" id="category" style="width: 100%" value="{{ old('category') }}">
                                                <option value="">- Pilih Kategori -</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category', $news->news_category_id) == $category->id ? "selected" : "" }}>{{ $category->name_id }} | {{ $category->name_en }}</option>
                                                @endforeach
                                            </select>
                                            @error('category') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        {{-- <div class="form-group col-md">
                                            <label for="type_news">Jenis Berita</label>
                                            <select class="form-control" name="type_news" id="type_news" style="width: 100%" value="{{ old('type_news') }}">
                                                <option value="">- Jenis Berita -</option>
                                                <option value="news"  {{ old('category', $news->type) == 'news' ? "selected" : "" }}> Berita | News </option>
                                                <option value="event" {{ old('category', $news->type) == 'event' ? "selected" : "" }}> Acara | Event </option>
                                                
                                            </select>
                                            @error('type_news') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div> --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="description_id">Deskripsi Berita</label>
                                        <textarea class="form-control" id="editor1" rows="5" name="description_id" placeholder="">{{ old('description_id', $news->description_id) }}</textarea>
                                        @error('description_id') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="description_en">Deskripsi Berita (English)</label>
                                        <textarea class="form-control" id="editor2" rows="5" name="description_en" placeholder="">{{ old('description_en', $news->description_en) }}</textarea>
                                        @error('description_en') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div> --}}
                                    <div class="form-group col-md-4">
                                        <p style="font-weight: 600">Gambar</p>
                                        <img src="{{ $news->image_url }}" class="img-preview img-fluid mb-3">
                                        <p id="file-name"></p>
                                        <label class="image-label" for="image"><i class="fas fa-file-upload"></i><span>Cari File</span></label>
                                        <input type="file" class="form-control-file" id="image" name="image" onchange="previewImage()">
                                        <div class="info">
                                            <p>Max size : 1MB</p>
                                        </div>
                                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-rounded">Edit berita</button>
                                    <a href="{{ route('admin.news.index') }}" class="btn btn-warning btn-rounded ml-2">Kembali</a>
                                </form>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
            <footer class="footer">
				<div class="container-fluid">
					
					<div class="copyright ml-auto">
						{{ date("Y") }}, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.tupaitech.net">Tupai Tech</a>
					</div>				
				</div>
			</footer>
        </div>
    </div>
</body>

@endsection

@section('js')
    <script>
        // thumbnail
        function previewImage() {
            const image = document.querySelector('#image');
            const imagePreview = document.querySelector('.img-preview');
            let filename = document.getElementById('file-name');
            imagePreview.style.display='block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            filename.innerHTML = image.files[0].name;

            oFReader.onload =function (oFREvent) {
                imagePreview.src = oFREvent.target.result;					
            }
        }


        var editor = CKEDITOR.replace("editor1", {
            height: 800,
        });
        CKFinder.setupCKEditor(editor);
        var editor2 = CKEDITOR.replace("editor2", {
            height: 800,
        });
        CKFinder.setupCKEditor(editor2);
    </script>
@endsection
