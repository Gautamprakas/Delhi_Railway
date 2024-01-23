<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    Screened / Data
                    <small></small>
                </h2>
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header <?php echo BG_BLUE_GREY; ?>">
                            <h2>
                                Media [<?php $this->load->helper("url"); echo $this->uri->segment(4); ?>]
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="example">
                                    <thead class="<?php echo BG_BLUE_GREY; ?>">
                                        <tr>
                                            <th>#</th>
                                            <th>Label</th>
                                            <th>Content</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sno=0; foreach($data as $row): ?>
                                        <tr>
                                          <td><?php echo ++$sno; ?></td>
                                          <td><?php echo $row->label; ?></td>
                                          <td>
                                            <?php if($row->media_type == "image"){ ?>
                                                <a href="<?php echo $row->media_url; ?>" target="_blank">
                                                    <img src="<?php echo $row->media_url; ?>" alt="" width="100px">
                                                </a>
                                            <?php } ?>

                                            <?php if($row->media_type == "video"){ ?>
                                                <video  width="200" loop autoplay>
                                                    <source src="<?php echo $row->media_url; ?>" type="video/mp4">
                                                    Your browser does not support HTML5 video.
                                                </video>
                                            <?php } ?>
                                                
                                          </td>
                                        </tr>
                                       <?php endforeach; ?>
                                    </tbody>
                                </table>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>