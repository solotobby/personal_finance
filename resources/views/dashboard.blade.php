@extends('layouts.master')
@section('body-class', '')
@section('styles')
        <link href="{{ asset('assets/plugins/apexcharts/apexcharts.css') }}" rel="stylesheet">
@endsection


@section('content')
        <div class="page-container">
          @include('layouts.components.sidebar', ['page' => 'Dashboard'])
            <div class="page-content">
                @include('layouts.components.page-header', ['title' => 'Dashboard'])
              <div class="main-wrapper">
                
                <div class="row">
                  <div class="col-lg-6">
                    <div class="card main-chart-card">
                        <div class="card-body">
                          <div id="apex3"></div>
                        </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="card stats-card">
                          <div class="card-body">
                            <div class="stats-info">
                              <h5 class="card-title">$30K<span class="stats-change stats-change-danger">-8%</span></h5>
                              <p class="stats-text">Total revenue</p>
                            </div>
                            <div class="stats-icon change-danger">
                              <i class="material-icons">trending_down</i>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="card stats-card">
                          <div class="card-body">
                            <div class="stats-info">
                              <h5 class="card-title">$21K<span class="stats-change stats-change-danger">-8%</span></h5>
                              <p class="stats-text">Total revenue</p>
                            </div>
                            <div class="stats-icon change-danger">
                              <i class="material-icons">trending_down</i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="card stats-card">
                          <div class="card-body">
                            <div class="stats-info">
                                <h5 class="card-title">1681<span class="stats-change stats-change-success">+16%</span></h5>
                                <p class="stats-text">Unique visitors</p>
                            </div>
                            <div class="stats-icon change-success">
                                <i class="material-icons">trending_up</i>
                            </div>
                        </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="card stats-card">
                          <div class="card-body">
                            <div class="stats-info">
                                <h5 class="card-title">4743<span class="stats-change stats-change-success">+12%</span></h5>
                                <p class="stats-text">Total investments</p>
                            </div>
                            <div class="stats-icon change-success">
                                <i class="material-icons">trending_up</i>
                            </div>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-4">
                      <div class="card card-bg">
                        <div class="card-body">
                          <h5 class="card-title">Transactions</h5>
                          <div class="transactions-list">
                            <div class="tr-item">
                              <div class="tr-company-name">
                                <div class="tr-icon tr-card-icon tr-card-bg-primary text-white">
                                  <i data-feather="thumbs-up"></i>
                                </div>
                                <div class="tr-text">
                                  <h4 class="text-white">Facebook</h4>
                                  <p>02 March</p>
                                </div>
                              </div>
                              <div class="tr-rate">
                                <p><span class="text-success">+$24</span></p>
                              </div>
                            </div>
                          </div>
                          <div class="transactions-list">
                            <div class="tr-item">
                              <div class="tr-company-name">
                                <div class="tr-icon tr-card-icon tr-card-bg-success text-white">
                                  <i data-feather="credit-card"></i>
                                </div>
                                <div class="tr-text">
                                  <h4 class="text-white">Visa</h4>
                                  <p>02 March</p>
                                </div>
                              </div>
                              <div class="tr-rate">
                                <p><span class="text-success">+$300</span></p>
                              </div>
                            </div>
                          </div>
                          <div class="transactions-list">
                            <div class="tr-item">
                              <div class="tr-company-name">
                                <div class="tr-icon tr-card-icon tr-card-bg-danger text-white">
                                  <i data-feather="tv"></i>
                                </div>
                                <div class="tr-text">
                                  <h4 class="text-white">Netflix</h4>
                                  <p>02 March</p>
                                </div>
                              </div>
                              <div class="tr-rate">
                                <p><span class="text-danger">-$17</span></p>
                              </div>
                            </div>
                          </div>
                          <div class="transactions-list">
                            <div class="tr-item">
                              <div class="tr-company-name">
                                <div class="tr-icon tr-card-icon tr-card-bg-warning text-white">
                                  <i data-feather="shopping-cart"></i>
                                </div>
                                <div class="tr-text">
                                  <h4 class="text-white">Themeforest</h4>
                                  <p>02 March</p>
                                </div>
                              </div>
                              <div class="tr-rate">
                                <p><span class="text-danger">-$220</span></p>
                              </div>
                            </div>
                          </div>
                          <div class="transactions-list">
                            <div class="tr-item">
                              <div class="tr-company-name">
                                <div class="tr-icon tr-card-icon tr-card-bg-info text-white">
                                  <i data-feather="dollar-sign"></i>
                                </div>
                                <div class="tr-text">
                                  <h4 class="text-white">PayPal</h4>
                                  <p>02 March</p>
                                </div>
                              </div>
                              <div class="tr-rate">
                                <p><span class="text-success">+20%</span></p>
                              </div>
                            </div>
                          </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="card widget widget-info card-bg">
                      <div class="card-body">
                        <div class="widget-info-container">
                            <div class="widget-info-image" style="background: url('../../assets/images/premium.svg')"></div>
                            <h5 class="widget-info-title text-white">Advanced Security</h5>
                            <p class="widget-info-text">Lorem ipsum dolor sit amet. Nunc cursus tempor sapien, et mattis libero dapibus ut. Ut a ante sit amet arcu imperdiet</p>
                            <a href="#" class="btn btn-primary widget-info-action">Try Premium for free</a>
                        </div>
                    </div>
                  </div>
                  </div>
                <div class="col-lg-4">
                  <div class="card stat-widget card-bg">
                    <div class="card-body">
                      <h5 class="card-title">Top Authors</h5>
                      <div class="transactions-list">
                        <div class="tr-item">
                          <div class="tr-company-name">
                            <div class="tr-img tr-card-img">
                              <img src="../../assets/images/avatars/profile-image.png" alt="...">
                            </div>
                            <div class="tr-text">
                              <h4 class="text-white">John Doe</h4>
                              <p>23 items sold</p>
                            </div>
                          </div>
                          <div class="tr-rate">
                            <p><span>$300</span></p>
                          </div>
                        </div>
                      </div>
                      <div class="transactions-list">
                        <div class="tr-item">
                          <div class="tr-company-name">
                            <div class="tr-img tr-card-img">
                              <img src="../../assets/images/avatars/profile-image.png" alt="...">
                            </div>
                            <div class="tr-text">
                              <h4 class="text-white">Ann Doe</h4>
                              <p>19 items sold</p>
                            </div>
                          </div>
                          <div class="tr-rate">
                            <p><span>$270</span></p>
                          </div>
                        </div>
                      </div>
                      <div class="transactions-list">
                        <div class="tr-item">
                          <div class="tr-company-name">
                            <div class="tr-img tr-card-img">
                              <img src="../../assets/images/avatars/profile-image.png" alt="...">
                            </div>
                            <div class="tr-text">
                              <h4 class="text-white">Lisa Doe</h4>
                              <p>14 items sold</p>
                            </div>
                          </div>
                          <div class="tr-rate">
                            <p><span>$404</span></p>
                          </div>
                        </div>
                      </div>
                      <div class="transactions-list">
                        <div class="tr-item">
                          <div class="tr-company-name">
                            <div class="tr-img tr-card-img">
                              <img src="../../assets/images/avatars/profile-image.png" alt="...">
                            </div>
                            <div class="tr-text">
                              <h4 class="text-white">John Doe</h4>
                              <p>10 items sold</p>
                            </div>
                          </div>
                          <div class="tr-rate">
                            <p><span>$500</span></p>
                          </div>
                        </div>
                      </div>
                      <div class="transactions-list">
                        <div class="tr-item">
                          <div class="tr-company-name">
                            <div class="tr-img tr-card-img">
                              <img src="../../assets/images/avatars/profile-image.png" alt="...">
                            </div>
                            <div class="tr-text">
                              <h4 class="text-white">Ann Doe</h4>
                              <p>8 items sold</p>
                            </div>
                          </div>
                          <div class="tr-rate">
                            <p><span>$299</span></p>
                          </div>
                        </div>
                      </div>
                      </div>
                  </div>
                </div>
                  
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="card card-bg">
                    <div class="card-body">
                      <h5 class="card-title">Sales</h5>
                      <div id="sparkline1"></div>

                  </div>
                </div>
                </div>
                <div class="col-lg-4">
                  <div class="card card-bg">
                    <div class="card-body">
                      <h5 class="card-title">Visitors</h5>
                      <div id="sparkline2"></div>
                  </div>
                </div>
                </div>
                <div class="col-lg-4">
                  <div class="card card-bg">
                    <div class="card-body">
                      <h5 class="card-title">Projects</h5>
                      <div id="sparkline3"></div>
                  </div>
                </div>
                </div>
              </div>
              
              </div>
              @include('layouts.components.footer')
            </div>
        </div>
        @include('layouts.components.sidebar-overlay')
      @endsection

    @section('scripts')
        <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    @endsection