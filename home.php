<?php



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="./node_modules/bootstrap-icons/font/bootstrap-icons.css" />
    <script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <style>
        html { font-size: 105%; }
        /* body { background-color: blue; } */


        .left-column {
          position: fixed;
          width: 40vw;
          height: calc(100vh - 50px);
          overflow-y: auto;
        }

        .right-column {
          overflow-x: hidden;
          overflow-y: auto;
          scroll-behavior: smooth;
          margin-left: 40vw;
          height: calc(100vh - 50px);
        }

        .left-column::-webkit-scrollbar, .right-column::-webkit-scrollbar {
          width: 6px;
        }

        .left-column::-webkit-scrollbar-thumb, .right-column::-webkit-scrollbar-thumb {
          background-color: rgba(0, 0, 0, 0.2);
          border-radius: 4px;
        }

        .left-column::-webkit-scrollbar-track, .right-column::-webkit-scrollbar-track {
          background-color: rgba(0, 0, 0, 0.05);
        }

        .mobile-display {
          position: fixed;
          bottom: 0;
          left: 0;
          right: 0;
          z-index: 1030;
          box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
          display: none;
        }

        .pc-container {
          max-width: 30rem;
        }

        @media (max-aspect-ratio: 4/3) {
          html { font-size: 100%; }
          
          .pc-container {
            margin-left: 0rem;
            width: 100%;
            max-width: 100%;
            padding-bottom: 60px;
          }

          .mobile-display {
            display: grid;
          }
          .pc-display {
            display: none;
          }
        }

        .navbar-height {
          height: 50px;
        }
    </style>
</head>
<body class="background-color">
  <div class="sticky-top navbar-height">
    <ul class="nav nav-underline bg-light nav-fill border">
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">Current</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
    </ul>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-auto left-column pc-display">
        <form>
          <div class="form-floating mb-2">
            <input type="text" id="title" class="form-control" placeholder="Title" />
            <label for="title">Title</label>
          </div>
          <div class="form-floating mb-2">
            <textarea id="description" class="form-control" placeholder="Description" style="height: 100px;"></textarea>
            <label for="description">Description</label>
          </div>
          <div class="input-group mb-2">
            <input type="file" class="form-control" multiple />
            <span class="input-group-text">
              <i class="bi bi-paperclip"></i>
            </span>
          </div>
          <div class="input-group mb-2">
            <label class="input-group-text" for="header">Header</label>
            <select id="header" class="form-select">
              <option value="1" selected>Information</option>
              <option value="2">Warning</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-upload"></i>
          </button>
        </form>
      </div>
      <div class="col right-column pc-container">
        <div class="row row-cols-1 g-3">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Title</h5>
                        <p class="card-text">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        </p>
                    </div>
                    <img src="darkblue.png" />
                    <div class="px-3 py-2 d-flex justify-content-between align-items-center gap-2">
                        <small class="text-body-secondary flex-grow-1">3 mins ago</small>
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-arrow-up"></i>
                        </a>
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-download"></i>
                        </a>
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-share"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Title</h5>
                        <p class="card-text">
                            Lorem Ipsum is simply dummy text of the printing.
                        </p>
                    </div>
                    <img src="fff.png" />
                    <div class="px-3 py-2 d-flex justify-content-between align-items-center gap-2">
                        <small class="text-body-secondary flex-grow-1">3 mins ago</small>
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-arrow-up"></i>
                        </a>
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-download"></i>
                        </a>
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-share"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Title</h5>
                        <p class="card-text">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                        </p>
                    </div>
                    <img src="darkred.png" />
                    <div class="px-3 py-2 d-flex justify-content-between align-items-center gap-2">
                        <small class="text-body-secondary flex-grow-1">3 mins ago</small>
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-arrow-up"></i>
                        </a>
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-download"></i>
                        </a>
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-share"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Title</h5>
                        <p class="card-text">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                        </p>
                    </div>
                    <div class="px-3 py-2 d-flex justify-content-between align-items-center gap-2">
                        <small class="text-body-secondary flex-grow-1">3 mins ago</small>
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-arrow-up"></i>
                        </a>
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-download"></i>
                        </a>
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-share"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">Title</h5>
                      <p class="card-text">
                          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                      </p>
                  </div>
                  <img src="fff.png" />
                  <div class="px-3 py-2 d-flex justify-content-between align-items-center gap-2">
                        <small class="text-body-secondary flex-grow-1">3 mins ago</small>
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-arrow-up"></i>
                        </a>
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-download"></i>
                        </a>
                        <a href="#" class="btn btn-primary">
                            <i class="bi bi-share"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="mobile-display">
    <button type="button" class="btn btn-primary btn-lg rounded-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
      <i class="bi bi-upload fs-3"></i>
    </button>
  </div>
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload file</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" height="500">
          <form>
            <div class="form-floating mb-2">
              <input type="text" id="title" class="form-control" placeholder="Title" />
              <label for="title">Title</label>
            </div>
            <div class="form-floating mb-2">
              <textarea id="description" class="form-control" placeholder="Description" style="height: 100px;"></textarea>
              <label for="description">Description</label>
            </div>
            <div class="input-group mb-2">
              <input type="file" class="form-control" multiple />
              <span class="input-group-text">
                <i class="bi bi-paperclip"></i>
              </span>
            </div>
            <div class="input-group mb-2">
              <label class="input-group-text" for="header">Header</label>
              <select id="header" class="form-select">
                <option value="1" selected>Information</option>
                <option value="2">Warning</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">
              <i class="bi bi-upload"></i>
            </button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Wait</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>