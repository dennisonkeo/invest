@if(count($errors))
											<div class="form-group">
												<div class="alert alert-danger" style="margin: 1%;">
													<ul>
														@foreach($errors->all() as $error)
														<li>{{$error}}</li>
														@endforeach
													</ul>
												</div>
											</div>
									@endif