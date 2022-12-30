@extends('layouts.public')
@section('layout_title', 'Daftar Wisata')
@section('layout_content')
<style>
    h3{
        color: blue;
    }
</style>

        <section class="section-testimonial-heading" id="testimonialHeading">
			<div class="container">
				<div class="row">
					<div class="col text-center">
					<h2>Ulasan</h2>
					<p>Pengalaman terbaik mereka menggunakan Wisatakuy</p>
					</div>
				</div>
			</div>
		</section>

		<section class="section section-testimonial-content" id="testimonialContent">
			<div class="container">
                <div class="row pt-1 gx-1 gy-1">
                    @foreach ($ulasans as $ulasan)
                        <div class="col-md-3">
                            <div class="card" style="width: 15rem;">
                                <img class="card-img-top" src="https://i.pravatar.cc/300" alt="Card image cap">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <a href="{{ route('public.wisata', $ulasan->id_objek_wisata) }}">{{$ulasan->nama_pariwisata}}</a>
                                    </h3>
                                    <p class="card-text">{!!$ulasan->ulasan!!}</p>

                                    <p class="mb-4" style="text-align: end">~{{$ulasan->nama_pengguna}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                        {{-- <div class="col-md-3">
                            <div class="card" style="width: 15rem;">
                                <img class="card-img-top" src="https://awsimages.detik.net.id/visual/2021/11/12/ilustrasi-manusia-jenius-dok-freepik_43.jpeg?w=450&q=90" alt="Card image cap">
                                <div class="card-body">
                                  <h5 class="card-title">Air Terjun Coban Rondo</h5>
                                  <p class="card-text">"Perjalanan yang sungguh luar biasa berkat website Holiyou"</p>
                                </div>
                            </div>
                        </div> --}}


                </div>
                <div aria-label="Page navigation example" class="row" style="margin-top: 20px">
                    {{ $ulasans->links() }}
                </div>
			</div>
		</section>



@endsection
